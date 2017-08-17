<?php

require __DIR__ . '/TableModel.php';

class Rep implements TableModel {

    private $fname;
    public $buf;
    private $meta;

    public function __construct( $fname = __DIR__ . '/../../Grunfeld.csv' )
    {
        if(!file_exists($fname)) throw new Exception("db file do not exist");
        $this->fname = $fname;
    }

    public function getHeaders()
    {
        if(!$this->meta)
        {
            $line = fgets(fopen($this->fname, 'r'));
            $line = trim($line);
            $this->meta = explode(',', $line);

        }
        return $this->meta;
    }

    /**
     * @return void
     */
    public function load()
    {
        $this->buf = [];
        $f = fopen($this->fname, "r");
        fgets($f);
        while (!feof($f)) {
            $line = trim(fgets($f));
            array_push($this->buf, $line);
        }
        fclose($f);
    }

    /**
     * @return void
     */
    public function save()
    {
        // TODO: Implement save() method.
    }

    /**
     * @param array $row
     * @return int offset
     */
    public function addRow(array $row)
    {
        // TODO: Implement addRow() method.
    }

    /**
     * @param int $offset
     * @param array $row
     * @return boolean
     */
    public function updateRow($offset, array $row)
    {
        // TODO: Implement updateRow() method.
    }

    /**
     * @param int $offset
     * @return array|null
     */
    public function getRow($offset)
    {
        // TODO: Implement getRow() method.
    }

    /**
     * @param $offset integer
     * @return boolean
     */
    public function deleteRow($offset)
    {
        // TODO: Implement deleteRow() method.
    }

    /**
     * @return array
     */
    public function getRows()
    {
        // TODO: Implement getRows() method.
    }

    /**
     * @return int
     */
    public function countRows()
    {
        // TODO: Implement countRows() method.
    }
}