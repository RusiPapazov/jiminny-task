<?php
namespace Rusi\Jiminny\Analysis;

use Rusi\Jiminny\Result;

interface AnalysisVisitorInterface
{
    public function visit(Result $result): void;
}