<?php

namespace Tests\Feature\Patterns;

use App\Patterns\Decorator\DangerousHtmlTagsFilter;
use App\Patterns\Decorator\InputFormat;
use App\Patterns\Decorator\MarkdownFormat;
use App\Patterns\Decorator\TextInput;

test('decorator', function () {
    $dangerousForumPost = <<<HERE
# Welcome

This is my first post on this **gorgeous** forum.

<script src="http://www.iwillhackyou.com/script.js">
  performXSSAttack();
</script>
HERE;

    $text = new TextInput;
    $markdown = new MarkdownFormat($text);
    $filtered = new DangerousHtmlTagsFilter($markdown);

    echo "text\n";
    echo display($text, $dangerousForumPost);

    echo "\n\nmarkdown\n";
    echo display($markdown, $dangerousForumPost);

    echo "\n\nfiltered\n";
    echo display($filtered, $dangerousForumPost);
});

function display(InputFormat $format, string $text): string {
    return $format->formatText($text);
}