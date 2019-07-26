<?php
declare(strict_types=1);

namespace RabinKarp;

class RabinKarp
{
    /**
     * Text where to search
     * @var string
     */
    private $text;

    /**
     * length of text
     * @var int
     */
    private $text_length;

    /**
     * hash of text
     * @var int
     */
    private $text_hash;

    public function __construct(string $text) {
        $this->text = $text;
        $this->text_length = strlen($this->text);
        $this->text_hash = $this->getHash($this->text, $this->text_length);
    }

    public function findInString(string $pattern): bool
    {
        $pattern_length = strlen($pattern);
        // if pattern longer than text, no need to find a match, it will be false
        if ($this->text_length < $pattern_length) {
            return false;
        }
        // if same size, we check if text and pattern are identical
        if ($this->text_length === $pattern_length) {
            return $this->text === $pattern;
        }

        $pattern_hash = $this->getHash($pattern, $pattern_length);

        return $this->checkMatch($pattern, $pattern_length, $pattern_hash);
    }

    public function findInArray(array $patterns): array
    {
        $rk_list = array();
        foreach($patterns as $pattern){
            array_push($rk_list, $this->findInString($pattern));
        }

        return $rk_list;
    }

    private function getHash(string $text, int $length): int
    {
        $hash = 0;
        for ($i = 0; $i < $length; ++$i) {
            $hash += ord($text[$i]);
        }

        return $hash;
    }

    private function checkMatch(string $pattern, int $pattern_length, int $pattern_hash): bool
    {
        for ($i = 0, $j = $this->text_length - $pattern_length; $i <= $j; ++$i) {
            // If match
            if ($pattern === substr($this->text, $i, $pattern_length)) {
                return true;
            }
            //When we come to the end of text, but found nothing...
            if ($i === $j) {
                return false;
            }
            $this->text_hash = ($this->text_hash - ord($this->text[$i])) + ord($this->text[$i + $pattern_length]);
        }
    }
}
