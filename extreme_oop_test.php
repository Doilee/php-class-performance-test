<?php
echo "Starting performance test uncle bob approved clean code way.. \n";

interface Incrementable {
    public function increment();
}

class Number implements Incrementable {
    private float $value;

	public function get() : float
    {
	    return $this->value;
	}

	public function set(float $value) : void
    {
	    $this->value = $value;
	}

    public function increment() : void
    {
        $this->set($this->value + 1);
    }
}

class Multiplier {
	private float $by = 2.65;
	private float $result;
	
	public function __construct(Number $number)
    {
		$this->result = $number->get() * $this->by;
	}
	
	public function getResult() {
		return $this->result;
	}
}

class Divider {
	private float $by = 2.66;
	private float $result;
    
    public function __construct(Number $number)
    {
        $this->result = $number->get() / $this->by;
    }

	public function getResult()
    {
		return $this->result;	
	}
}

class Test {
	public Number $number;

	public $history = [];

    public function __construct()
    {
        $this->number = new Number();
        $this->number->set(100);
    }

    public function multiply() {
		$this->number->set((new Multiplier($this->number))->getResult());
	}

	public function divide() {
        $this->number->set((new Divider($this->number))->getResult());
	}

    public function increment()
    {
        $this->number->increment();
    }

	public function pushToHistory() {
		$this->history[] = $this->number->get();
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
echo $test->number->get() . "\n";
echo "execution time took: " . microtime(true) - $start;
