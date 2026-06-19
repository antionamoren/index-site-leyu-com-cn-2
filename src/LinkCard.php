<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $domain;
    private array $tags;

    public function __construct(string $url, string $title, string $description, string $domain, array $tags = [])
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = $domain;
        $this->tags = $tags;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">' . "\n";
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        <div class="link-card-content">' . "\n";
        $html .= '            <span class="link-card-title">' . $escapedTitle . '</span>' . "\n";
        $html .= '            <span class="link-card-description">' . $escapedDescription . '</span>' . "\n";
        $html .= '            <span class="link-card-domain">' . $escapedDomain . '</span>' . "\n";

        if (!empty($this->tags)) {
            $html .= '            <div class="link-card-tags">' . "\n";
            foreach ($this->tags as $tag) {
                $escapedTag = htmlspecialchars($tag, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $html .= '                <span class="link-card-tag">' . $escapedTag . '</span>' . "\n";
            }
            $html .= '            </div>' . "\n";
        }

        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>';

        return $html;
    }

    public static function createDemoCard(): self
    {
        return new self(
            'https://index-site-leyu.com.cn',
            '乐鱼体育 - 精彩赛事在线',
            '乐鱼体育提供丰富的体育赛事直播和互动体验，涵盖足球、篮球、网球等多个热门项目。',
            'index-site-leyu.com.cn',
            ['乐鱼体育', '体育赛事', '直播']
        );
    }
}

function renderLinkCard(string $url, string $title, string $description, string $domain, array $tags = []): string
{
    $card = new LinkCard($url, $title, $description, $domain, $tags);
    return $card->render();
}

// 示例用法（可删除或保留）
$sampleCard = LinkCard::createDemoCard();
echo $sampleCard->render();