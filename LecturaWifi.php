<?php
    class LecturaWifi{
        public $Tarjeta;
        public $IEEE;
        public $ESSID;
        public $Mode;
        public $Frequency;
        public $AccessPoint;
        public $BitRate;
        public $Velocidad;
        public $TxPower;
        public $RetryShortLimit;
        public $RTSThr;
        public $FragmentThr;
        public $PowerManagement;
        public $LinkQuality;
        public $SignalLevel;
        public $RxInvalidNwid;
        public $RxInvalidCrypt;
        public $RxInvalidFrag;
        public $TxExcessiveRetries;
        public $InvalidMisc;
        public $MissedBeacon;

        /*
        function __construct($Tarjeta,
                             $IEEE,
                             $ESSID,
                             $Mode,
                             $Frequency,
                             $AccessPoint,
                             $BitRate,
                             $TxPower,
                             $RetryShortLimit,
                             $RTSThr,
                             $FragmentThr,
                             $PowerManagement,
                             $LinkQuality,
                             $SignalLevel,
                             $RxInvalidNwid,
                             $RxInvalidCrypt,
                             $RxInvalidFrag,
                             $TxExcessiveRetries,
                             $InvalidMisc,
                             $MissedBeacon){
                                 this.$Tarjeta = $Tarjeta;
                                 this.$IEEE = $IEEE;
                                 this.$ESSID = $ESSID;
                                 this.$Mode = $Mode;
                                 this.$Frequency = $Frequency;
                                 this.$AccessPoint = $AccessPoint;
                                 this.$BitRate = $BitRate;
                                 this.$TxPower = $TxPower;
                                 this.$RetryShortLimit = $RetryShortLimit;
                                 this.$RTSThr = $RTSThr;
                                 this.$FragmentThr = $FragmentThr;
                                 this.$PowerManagement = $PowerManagement;
                                 this.$LinkQuality = $LinkQuality;
                                 this.$SignalLevel = $SignalLevel;
                                 this.$RxInvalidNwid = $RxInvalidNwid;
                                 this.$RxInvalidCrypt = $RxInvalidCrypt;
                                 this.$RxInvalidFrag = $RxInvalidFrag;
                                 this.$TxExcessiveRetries = $TxExcessiveRetries;
                                 this.$InvalidMisc = $InvalidMisc;
                                 this.$MissedBeacon = $MissedBeacon;
        }*/

        

        /**
         * Get the value of Tarjeta
         */ 
        public function getTarjeta()
        {
                return $this->Tarjeta;
        }

        /**
         * Set the value of Tarjeta
         *
         * @return  self
         */ 
        public function setTarjeta($Tarjeta)
        {
                $this->Tarjeta = $Tarjeta;

                return $this;
        }

        /**
         * Get the value of IEEE
         */ 
        public function getIEEE()
        {
                return $this->IEEE;
        }

        /**
         * Set the value of IEEE
         *
         * @return  self
         */ 
        public function setIEEE($IEEE)
        {
                $this->IEEE = $IEEE;

                return $this;
        }

        /**
         * Get the value of ESSID
         */ 
        public function getESSID()
        {
                return $this->ESSID;
        }

        /**
         * Set the value of ESSID
         *
         * @return  self
         */ 
        public function setESSID($ESSID)
        {
                $this->ESSID = $ESSID;

                return $this;
        }

        /**
         * Get the value of Mode
         */ 
        public function getMode()
        {
                return $this->Mode;
        }

        /**
         * Set the value of Mode
         *
         * @return  self
         */ 
        public function setMode($Mode)
        {
                $this->Mode = $Mode;

                return $this;
        }

        /**
         * Get the value of Frequency
         */ 
        public function getFrequency()
        {
                return $this->Frequency;
        }

        /**
         * Set the value of Frequency
         *
         * @return  self
         */ 
        public function setFrequency($Frequency)
        {
                $this->Frequency = $Frequency;

                return $this;
        }

        /**
         * Get the value of AccessPoint
         */ 
        public function getAccessPoint()
        {
                return $this->AccessPoint;
        }

        /**
         * Set the value of AccessPoint
         *
         * @return  self
         */ 
        public function setAccessPoint($AccessPoint)
        {
                $this->AccessPoint = $AccessPoint;

                return $this;
        }

        /**
         * Get the value of BitRate
         */ 
        public function getBitRate()
        {
                return $this->BitRate;
        }

        /**
         * Set the value of BitRate
         *
         * @return  self
         */ 
        public function setBitRate($BitRate)
        {
                $this->BitRate = $BitRate;

                return $this;
        }

        /**
         * Get the value of Velocidad
         */ 
        public function getVelocidad()
        {
                return $this->Velocidad;
        }

        /**
         * Set the value of Velocidad
         *
         * @return  self
         */ 
        public function setVelocidad($Velocidad)
        {
                $this->Velocidad = $Velocidad;

                return $this;
        }

        /**
         * Get the value of TxPower
         */ 
        public function getTxPower()
        {
                return $this->TxPower;
        }

        /**
         * Set the value of TxPower
         *
         * @return  self
         */ 
        public function setTxPower($TxPower)
        {
                $this->TxPower = $TxPower;

                return $this;
        }

        /**
         * Get the value of RetryShortLimit
         */ 
        public function getRetryShortLimit()
        {
                return $this->RetryShortLimit;
        }

        /**
         * Set the value of RetryShortLimit
         *
         * @return  self
         */ 
        public function setRetryShortLimit($RetryShortLimit)
        {
                $this->RetryShortLimit = $RetryShortLimit;

                return $this;
        }

        /**
         * Get the value of RTSThr
         */ 
        public function getRTSThr()
        {
                return $this->RTSThr;
        }

        /**
         * Set the value of RTSThr
         *
         * @return  self
         */ 
        public function setRTSThr($RTSThr)
        {
                $this->RTSThr = $RTSThr;

                return $this;
        }

        /**
         * Get the value of FragmentThr
         */ 
        public function getFragmentThr()
        {
                return $this->FragmentThr;
        }

        /**
         * Set the value of FragmentThr
         *
         * @return  self
         */ 
        public function setFragmentThr($FragmentThr)
        {
                $this->FragmentThr = $FragmentThr;

                return $this;
        }

        /**
         * Get the value of PowerManagement
         */ 
        public function getPowerManagement()
        {
                return $this->PowerManagement;
        }

        /**
         * Set the value of PowerManagement
         *
         * @return  self
         */ 
        public function setPowerManagement($PowerManagement)
        {
                $this->PowerManagement = $PowerManagement;

                return $this;
        }

        /**
         * Get the value of LinkQuality
         */ 
        public function getLinkQuality()
        {
                return $this->LinkQuality;
        }

        /**
         * Set the value of LinkQuality
         *
         * @return  self
         */ 
        public function setLinkQuality($LinkQuality)
        {
                $this->LinkQuality = $LinkQuality;

                return $this;
        }

        /**
         * Get the value of SignalLevel
         */ 
        public function getSignalLevel()
        {
                return $this->SignalLevel;
        }

        /**
         * Set the value of SignalLevel
         *
         * @return  self
         */ 
        public function setSignalLevel($SignalLevel)
        {
                $this->SignalLevel = $SignalLevel;

                return $this;
        }

        /**
         * Get the value of RxInvalidNwid
         */ 
        public function getRxInvalidNwid()
        {
                return $this->RxInvalidNwid;
        }

        /**
         * Set the value of RxInvalidNwid
         *
         * @return  self
         */ 
        public function setRxInvalidNwid($RxInvalidNwid)
        {
                $this->RxInvalidNwid = $RxInvalidNwid;

                return $this;
        }

        /**
         * Get the value of RxInvalidCrypt
         */ 
        public function getRxInvalidCrypt()
        {
                return $this->RxInvalidCrypt;
        }

        /**
         * Set the value of RxInvalidCrypt
         *
         * @return  self
         */ 
        public function setRxInvalidCrypt($RxInvalidCrypt)
        {
                $this->RxInvalidCrypt = $RxInvalidCrypt;

                return $this;
        }

        /**
         * Get the value of RxInvalidFrag
         */ 
        public function getRxInvalidFrag()
        {
                return $this->RxInvalidFrag;
        }

        /**
         * Set the value of RxInvalidFrag
         *
         * @return  self
         */ 
        public function setRxInvalidFrag($RxInvalidFrag)
        {
                $this->RxInvalidFrag = $RxInvalidFrag;

                return $this;
        }

        /**
         * Get the value of TxExcessiveRetries
         */ 
        public function getTxExcessiveRetries()
        {
                return $this->TxExcessiveRetries;
        }

        /**
         * Set the value of TxExcessiveRetries
         *
         * @return  self
         */ 
        public function setTxExcessiveRetries($TxExcessiveRetries)
        {
                $this->TxExcessiveRetries = $TxExcessiveRetries;

                return $this;
        }

        /**
         * Get the value of InvalidMisc
         */ 
        public function getInvalidMisc()
        {
                return $this->InvalidMisc;
        }

        /**
         * Set the value of InvalidMisc
         *
         * @return  self
         */ 
        public function setInvalidMisc($InvalidMisc)
        {
                $this->InvalidMisc = $InvalidMisc;

                return $this;
        }

        /**
         * Get the value of MissedBeacon
         */ 
        public function getMissedBeacon()
        {
                return $this->MissedBeacon;
        }

        /**
         * Set the value of MissedBeacon
         *
         * @return  self
         */ 
        public function setMissedBeacon($MissedBeacon)
        {
                $this->MissedBeacon = $MissedBeacon;

                return $this;
        }
    }