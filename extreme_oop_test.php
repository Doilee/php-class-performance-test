<?php
echo "Starting performance test with O(n) classes.. \n";

class Multiplier {
	private float $by = 2.65;
	private float $result;
	
	public function __construct(float $number) {
		$this->result = $number * $this->by;
	}
	
	public function getResult() {
		return $this->result;
	}
}

class Divider {
	private float $by = 2.66;
	private float $result;
    
    public function __construct(float $number) {
        $this->result = $number / $this->by;
    }

	public function getResult() {
		return $this->result;	
	}
}

class Test {
	public $variable = 'hi';
	public $number = 100;
	public $history = [];

	public function multiply() {
		$this->number = (new Multiplier($this->number))->getResult();
	}

	public function divide() {
		$this->number = (new Divider($this->number))->getResult();
	}

	public function pushToHistory() {
		$this->history[] = $this->number;
	}

	public function getMiddleOfHistory() {
		return $this->history[500_000];	
	}
}

$start = microtime(true);

$test = new Test();

for ($i=0;$i < 10_000_000;$i++) {
	$test->multiply();
	$test->divide();

	$test->pushToHistory();
}

echo $test->getMiddleOfHistory() . "\n";
echo $test->number . "\n";
echo "execution time took: " . microtime(true) - $start;
