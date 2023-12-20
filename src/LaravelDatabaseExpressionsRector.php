<?php

declare(strict_types=1);

namespace Remarkablemark\RectorLaravelDatabaseExpressions;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class LaravelDatabaseExpressionsRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Fix Laravel 10 database expressions', [
                new CodeSample(
                    "DB::select(DB::raw('select 1'));",
                    "DB::select(DB::raw('select 1')->getValue(DB::getQueryGrammar()));"
                )
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
        $subNode = $node->args[0]->value ?? null;

        if (
            ! isset($subNode->class) ||
            $this->getName($node->name) !== 'select' ||
            strpos($this->getName($subNode->class), 'DB') === false ||
            $this->getName($subNode->name) !== 'raw'
        ) {
            return null;
        }

        $arguments[] = new Arg(
            new StaticCall(
            new Name('DB'),
                'getQueryGrammar'
            )
        );

        $node->args[0]->value = new MethodCall(
            $subNode,
            new Identifier('getValue'),
            $arguments
        );

        return $node;
    }
}
