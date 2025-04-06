<?php
namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    private $token;
    private $chat_id;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
    }

    public function handleRequest(Request $request)
    {
        $update = $request->all();

        if (isset($update['message'])) {
            $message = $update['message'];
            $this->chat_id = $message['chat']['id'];
            $text = $message['text'] ?? '';

            if ($text == '/start') {
                $this->handleStartCommand();
            } elseif ($group = Group::where('name', $text)->first()) {
                $this->handleGroupSelection($group);
            } else {
                $this->sendDefaultMessage();
            }
        }

        // Respond with an empty 200 OK
        return response()->json(['status' => 'ok']);
    }

    private function handleStartCommand()
    {
        $groups = Group::all();
        $message = "Welcome to the FAQ Bot!\n\nAvailable groups:\n";
        foreach ($groups as $group) {
            $message .= "- " . $group->name . "\n";
        }

        $this->sendMessage($message);
    }

    private function handleGroupSelection(Group $group)
    {
        $faqs = FAQ::where('group_id', $group->id)->get();
        if ($faqs->isEmpty()) {
            $this->sendMessage("No FAQs found for this group.");
            return;
        }

        $message = "FAQs for " . $group->name . ":\n\n";
        foreach ($faqs as $faq) {
            $message .= "Q: " . $faq->question . "\n";
            $message .= "A: " . $faq->answer . "\n\n";
        }

        $this->sendMessage($message);
    }

    private function sendDefaultMessage()
    {
        $this->sendMessage("I didn't understand that command. Please use /start to see available groups.");
    }

    private function sendMessage(string $text)
    {
        Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
            'chat_id' => $this->chat_id,
            'text' => $text
        ]);
    }
}