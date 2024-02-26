<?php

declare(strict_types=1);

namespace Remarkablemark\RectorLaravelDatabaseExpressions;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class LaravelDatabaseExpressionsRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Fix Laravel 10 database expressions',
            [
                new CodeSample(
                    "DB::select(DB::raw('select 1'));",
                    "DB::select('select 1');"
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class, StaticCall::class];
    }

    /**
     * @param MethodCall|StaticCall $node
     */
    public function refactor(Node $node): ?Node
    {
        /** @var Node */
        $childNode = $node->args[0]->value ?? null;

        $methodName = $this->getName($node->name);
        $childClassName = isset($childNode->class) ? $this->getName($childNode->class) : '';
        $childMethodName = isset($childNode->name) ? $this->getName($childNode->name) : '';

        if (
            // skip `DB::table()->select()`
            ($node instanceof MethodCall && 'select' === $methodName)
            // match `DB::select()` or `Model::selectRaw()`
            || !('select' === $methodName || str_ends_with($methodName, 'Raw'))
            // match `DB::raw()`
            || !str_ends_with($childClassName, 'DB') || 'raw' !== $childMethodName
        ) {
            return null;
        }

        $node->args[0]->value = $childNode->args[0]->value;

        return $node;
    }
}
