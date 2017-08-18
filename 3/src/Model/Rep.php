<?php

require __DIR__ . '/TableModel.php';

class Rep implements TableModel {

    private $fname;
    public $buf;
    public $meta;

    public function __construct( $fname = __DIR__ . '/../../Grunfeld.csv' )
    {
        $this->fname = $fname;
        $this->meta = [];
        $this->buf = [];
    }

    public function setHeaders($meta){
        $this->meta = $meta;
    }

    public function strToArray($str){
        $str = trim($str);
        return explode(',', $str);
    }

    public  function arrayToStr(&$arr){
        $res = '';
        $cm = count($arr) - 1;
        for($i=0; $i < $cm; $i++)
            $res .= $arr[$i] . ',';
        $res .= "{$arr[$cm]}\n\r";
        return $res;
    }

    public function getHeaders()
    {
        if(!$this->meta)
        {
            if($f = fopen($this->fname, 'r')){
                $line = fgets($f);
                $this->meta = $this->strToArray($line);
            }
        }
        return $this->meta;
    }

    /**
     * @return void
     */
    public function load()
    {
        $this->buf = [];
        if($f = fopen($this->fname, "r")){
            fgets($f);
            while (!feof($f)) {
                $line = trim(fgets($f));
                if($line){
                    array_push( $this->buf, $this->strToArray($line) );
                }
            }
            fclose($f);
        }
    }

    /**
     * @return void
     */
    public function save()
    {
        $meta = $this->getHeaders();
        $f = fopen($this->fname, "w");
        fwrite( $f, $this->arrayToStr($meta) );
        for($i=0; $i < count($this->buf); $i++)
            fwrite( $f, $this->arrayToStr($this->buf[$i]) );
        fclose($f);
    }

    /**
     * @param array $row
     * @return int offset
     */
    public function addRow(array $row)
    {
        array_push($this->buf, $row);
    }

    /**
     * @param int $offset
     * @param array $row
     * @return boolean
     */
    public function updateRow($offset, array $row)
    {
        for($i=0;$i < count($this->buf) && $offset >= 0 ; $i++, $offset--){
            if($offset === 0){
                $this->buf[$i] = $row;
                break;
            }
        }
    }

    /**
     * @param int $offset
     * @return array|null
     */
    public function getRow($offset)
    {
        for($i=0; $i < count($this->buf) && $offset >= 0 ; $i++, $offset--) {
            if ($offset === 0)
                return $this->buf[$i];
        }
    }

    /**
     * @param $offset integer
     * @return boolean
     */
    public function deleteRow($offset)
    {
        for($i=0; $i < count($this->buf) && $offset >= 0 ; $i++, $offset--) {
            if ($offset === 0){
                unset( $this->buf[$i] );
                $this->buf = array_values($this->buf);
                break;
            }
        }
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->buf;
    }

    /**
     * @return int
     */
    public function countRows()
    {
        return count($this->buf);
    }
}