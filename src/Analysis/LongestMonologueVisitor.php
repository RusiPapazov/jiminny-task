<?php
namespace Rusi\Jiminny\Analysis;

use Rusi\Jiminny\Result;

final class LongestMonologueVisitor implements AnalysisVisitorInterface
{
    private const RESULTING_PROPERTY_LITERAL = 'longest%sMonologue';
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function visit(Result $result): void
    {
        $data = $result->{$this->type};
        $resultingProp = sprintf(self::RESULTING_PROPERTY_LITERAL, ucfirst($this->type));
        $result->{$resultingProp} = max(
            array_map(
                static fn(array $times) => $times[1] - $times[0],
                $data,
            ),
        );
    }
}