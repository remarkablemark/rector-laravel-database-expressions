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
            'Fix Laravel 10 database expressions',
            [
                new CodeSample(
                    "DB::table('orders')->selectRaw(DB::raw('price * ? as price_with_tax'), [1.0825])->get();",
                    "DB::table('orders')->selectRaw('price * ? as price_with_tax', [1.0825])->get();",
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

        $className = $this->getName($node->name);
        $childClassName = isset($childNode->class) ? $this->getName($childNode->class) : '';
        $childMethodName = isset($childNode->name) ? $this->getName($childNode->name) : '';

        if (
            !str_ends_with($className, 'Raw')
            || !str_ends_with($childClassName, 'DB')
            || 'raw' !== $childMethodName
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
            $childNode,
            new Identifier('getValue'),
            $arguments
        );

        return $node;
    }
}
