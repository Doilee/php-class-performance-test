<?php
echo "Starting performance test with a single class.. \n";

class Test {
	public $number = 100;
	private $history = [];

	public function multiply() {
		$this->number = $this->number * 2.65;
	}

	public function divide() {
		$this->number = $this->number / 2.66;
	}
	
	public function increment() {
		$this->number++;
	}

	public function pushToHistory() {
		$this->history[] = $this->number;
	}

	public function getMiddleOfHistory() {
		return $this->history[5_000_000];
	}
}

$start = microtime(true);

$test = new Test();

for ($i=0;$i < 10_000_000;$i++) {
	$test->multiply();
	$test->divide();
	$test->increment();

	$test->pushToHistory();
}

echo $test->getMiddleOfHistory() . "\n";
echo $test->number . "\n";
echo "execution time took: " . microtime(true) - $start;
