<?php
/**
 * Created by PhpStorm.
 * User: Barthy
 * Date: 29.09.18
 * Time: 05:07
 */

namespace App\Service;


use Exception;

class NameParser
{

    /**
     * @var string
     */
    private $name;

    private function sanitize(): void
    {
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
    }

    private function decode(): void
    {
        $this->name = str_ireplace("-", " ", $this->name);
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws \Exception
     */
    public function parseName(string $name): string
    {
        $this->name = $name;

        $this->sanitize();
        $this->decode();
        $this->multiLine();

        return $this->getNameForRendering();
    }

    private function multiLine(): void
    {
        $nameArray = [];
        $space = strpos($this->name, ' ');

        while ($space !== false) {
            if ($space >= 8) {
                $nameArray[] = substr($this->name, 0, $space);
                $this->name = substr($this->name, $space + 1);
                $space = strpos($this->name, ' ');
            } else {
                $space = strpos($this->name, ' ', $space + 1);
            }
        }

        $nameArray[] = $this->name;
        $this->name = implode('<br/>', $nameArray);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getNameForRendering(): string
    {
        if ($this->name === null) {
            throw new Exception('Name must be parsed first. Use Nameparser::parseName.');
        }

        return $this->name;
    }
}
