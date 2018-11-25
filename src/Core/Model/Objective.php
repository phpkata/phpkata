<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use Webmozart\Assert\Assert;

final class Objective
{
    /**
     * @var string
     */
    private $hint;

    /**
     * @var Expectation[]
     */
    private $expectations;

    public function __construct(string $hint, array $expectations)
    {
        Assert::allIsInstanceOf($expectations, Expectation::class);
        $this->hint = $hint;
        $this->expectations = $expectations;
    }

    /**
     * @return ExecutionResult
     */
    public function run(): ExecutionResult
    {
        $result = new ResultBuilder();
        foreach ($this->expectations as $expectation) {
            $expectation->evaluate($result);
//            if ($expectation->isCompleted()) {
  //              $result->addSuccess($expectation);
    //        } else {
      //          $result->addError($expectation);
        //        break;
          //  }
        }

        return $result->buildResult();
    }
}
