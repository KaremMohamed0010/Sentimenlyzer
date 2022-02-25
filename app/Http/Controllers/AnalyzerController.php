<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentiment\Analyzer;

class AnalyzerController extends Controller
{
    public function index(Request $request)
    {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($request->text_to_analyze);
        $output_emoji = $analyzer->getSentiment("😁");
        $output_text_with_emoji = $analyzer->getSentiment("Aproko doctor made me 🤣.");
        $mood = '';
        if ($output_text['neg'] > 0 && $output_text['neg'] < 0.49) {
            $mood = 'Somewhat Negative ';
        } elseif ($output_text['neg'] > 0.49) {
            $mood = 'Mostly Negative';
        }

        if ($output_text['neu'] > 0 && $output_text['neg'] < 0.49) {
            $mood = 'Somewhat neutral ';
        } elseif ($output_text['neu'] > 0.49) {
            $mood = 'Mostly neutral';
        }

        if ($output_text['pos'] > 0 && $output_text['pos'] < 0.49) {
            $mood = 'Somewhat positive ';
        } elseif ($output_text['pos'] > 0.49) {
            $mood = 'Mostly positive';
        }
        //dd('Negative: ' . $output_text['neg'] . ' Positive: ' . $output_text['pos'] . ' Neutral: '. $output_text['neu']);
        return $mood;
    }
}
