<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use Star\PHPKata\Core\Input\ValueMatcher;

final class ResultBuilder
{
    /**
     * @var ValueMatcher[]
     */
    private $matchers = [];

    public function buildResult(): ExecutionResult
    {
        $successes = [];
        $errors = [];

        foreach ($this->matchers as $matcher) {
            if ($matcher->evaluate()) {
                $successes[] = $matcher->message();
            } else {
                $errors[] = $matcher->message();
            }
        }

        return ExecutionResult::replaceWithConstruct($successes, $errors);
    }

    public function addMatcher(ValueMatcher $matcher)
    {
        $this->matchers[] = $matcher;
    }
}
