<?php

class Operation
{

    private int $id;

    private string $libelleop;

    private string $codeop;

    private int  $numdde;

    /**
     * @param int $id
     * @param string $libelleop
     * @param string $codeop
     * @param int $numdde
     */
    public function __construct(int $id, string $libelleop, string $codeop, int $numdde)
    {
        $this->id = $id;
        $this->libelleop = $libelleop;
        $this->codeop = $codeop;
        $this->numdde = $numdde;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getLibelleop(): string
    {
        return $this->libelleop;
    }

    /**
     * @return string
     */
    public function getCodeop(): string
    {
        return $this->codeop;
    }

    /**
     * @return int
     */
    public function getNumdde(): int
    {
        return $this->numdde;
    }
}