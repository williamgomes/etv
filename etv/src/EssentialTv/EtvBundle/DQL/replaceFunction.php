<?php

namespace EssentialTv\EtvBundle\DQL;

use Doctrine\ORM\Query\Lexer; 
use Doctrine\ORM\Query\AST\Functions\FunctionNode; 


/**
 * "REPLACE" "(" StringPrimary "," StringSecondary "," StringThird ")"
 */
class replaceFunction extends FunctionNode{

    public $stringFirst; 
    public $stringSecond; 
    public $stringThird; 


    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        return  'replace('.$this->stringFirst->dispatch($sqlWalker) .','
                . $this->stringSecond->dispatch($sqlWalker) . ',' 
                .$this->stringThird->dispatch($sqlWalker) . ')';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser) {

        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->stringFirst = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->stringSecond = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->stringThird = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

}