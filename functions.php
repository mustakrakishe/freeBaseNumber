<?php
    class FreeBaseNumber{
        protected $availableChars;
        protected $base;
        protected $valueDigitIds;


        public function __construct($availableChars = null, $initValue = null){
            if($availableChars === null){
                $this->availableChars = range(0, 9);
            }
            else{
                $this->availableChars = array_map(function($char){
                        return strval($char);
                    },
                    $availableChars
                );
            }

            $pattern = '|[^' . implode('', $this->availableChars) . ']|';

            if($initValue !== null && !preg_match($pattern, $initValue)){
                $this->valueDigitIds = array_map(
                    function($char){
                        return array_search($char, $this->availableChars);
                    },
                    str_split($initValue)
                );
            }
            else{
                $this->valueDigitIds = [$this->availableChars[0]];
            }

            $this->base = count($this->availableChars);
        }

        public function getVal(){
            return implode('', array_map(function($valueDigitId){
                    return $this->availableChars[$valueDigitId];
                },
                $this->valueDigitIds)
            );
        }

        public function incVal($step = 1){
            $lastDigitId = count($this->valueDigitIds) - 1;
            $this->incDigit($lastDigitId, $step);
            return $this->getVal();
        }

        protected function incDigit($digitId, $step){
            $this->valueDigitIds[$digitId] += $step;

            if($this->valueDigitIds[$digitId] > $this->base - 1){
                $preDigitIncStep = intdiv($this->valueDigitIds[$digitId], $this->base);
                $this->valueDigitIds[$digitId] = $this->valueDigitIds[$digitId] % $this->base;

                if($digitId != 0){
                    $this->incDigit($digitId - 1, $preDigitIncStep);
                }
                else{
                    $this->valueDigitIds = array_merge([0], $this->valueDigitIds);
                    $this->incDigit(0, $preDigitIncStep);
                }
            }
        }
    }

    class FreeBasePass extends FreeBaseNumber {
        protected function incDigit($digitId, $step){
            $this->valueDigitIds[$digitId] += $step;

            if($this->valueDigitIds[$digitId] > $this->base - 1){
                $preDigitIncStep = intdiv($this->valueDigitIds[$digitId], $this->base);
                $this->valueDigitIds[$digitId] = $this->valueDigitIds[$digitId] % $this->base;

                if($digitId != 0){
                    $this->incDigit($digitId - 1, $preDigitIncStep);
                }
                else{
                    $this->valueDigitIds = array_merge([0], $this->valueDigitIds);
                    $this->incDigit(0, $preDigitIncStep-1);
                }
            }
        }
    }
