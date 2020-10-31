<?php
    class FreeBaseNumber{
        private $availableChars;
        private $base;
        private $valueDigitIds;


        public function __construct($initValue = 0, $availableChars = false){
            if($availableChars === false){
                $this->availableChars = range(0, 9);
            }
            else{
                $this->availableChars = array_map(function($char){
                        return strval($char);
                    },
                    $availableChars
                );
            }

            $this->valueDigitIds = array_map(function($char){
                    return array_search($char, $this->availableChars);
                },
                str_split($initValue)
            );

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
            return $this->incDigit($lastDigitId, $step);
        }

        public function incDigit($digitId, $step){
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

            return $this->getVal();
        }
    }