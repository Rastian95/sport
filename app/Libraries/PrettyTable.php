<?php

namespace App\Libraries;

class PrettyTable
{
    public $rows = array();

    public function __construct()
    {

    }

    public function add_row($args)
    {
        $this->rows[] = PHP_EOL;
        $this->rows[] = $args;
    }

    public function print_rows()
    {
        $rows = $this->rows;
        return $rows;
    }

    public function add_new_line($args = 1)
    {
        for ($i=0; $i < $args; $i++):
            $this->rows[] = PHP_EOL;
        endfor;
    }

    public function get_class()
    {
        return $this->css_class;
    }

    public function print()
    {
        return $this->generate_table();
    }

    public function count()
    {
        return count($this->rows);
    }

    private function generate_rows($rows)
    {
		$t = '';
        foreach ($rows as $row) {
            $t .= $row;
        }
        return $t;
    }

    private function generate_table()
    {
        $rows = $this->rows;
        return $this->generate_rows($rows);
    }

}


