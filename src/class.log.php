<?php
	/**
	 * -------------------------------
	 * Class Name: LogException
	 * Desc: A custom Exception to distinguish between the logger's exceptions and other exceptions.
	 */
	class LogException extends Exception {}


	/* -------------------------------
	 * Class Name: Log
	 * Desc: A small class to log data to a .log file. Useful for debugging, error logging, access loggin and more.
	 * -------------------------------
	 */

	class Log {
		
		private $logs;
		public $entry,
		       $log_status;
		
		const LOG_INACTIVE = 0,
		      LOG_ACTIVE = 1,
		      LOG_FAILED = 2;
		
		private $timestamp_format = 'd/m/y - G:i:s';
		
		/**	
		 * __construct function
		 * --------------------
		 * Initialize the class and set the time zone for proper
		 * timestamps.
		 * 
		 * @param String $timezone 
		 */
		
		public function __construct($logfiles = 'temp.log', $timezone = 0, $timestamp_format = null)
		{
			if(is_array($logfiles)){
				$this->logs = $logfiles;
			}else if(is_string($logfiles)){
				$this->logs = array('default' => $logfiles);
			}else{
				return false;
			}
			
			$timezone = (is_string($timezone)) ? $timezone : date_default_timezone_get();
			date_default_timezone_set($timezone);

			// If the user specified a custom timestamp format, use that
			if ($timestamp_format) $this->timestamp_format = $timestamp_format;
			
			$this->activateLog();
		}
		
		/**	
		 * __destruct function
		 * --------------------
		 * Deactivate the log
		 */
		
		public function __destruct()
		{
			$this->deactivateLog();
		}
		
		/**	
		 * entry function
		 * -------------
		 * Adds a single line of content to the log file
		 * 
		 * @param String $content 
		 */
		
		public function entry($entry, $meta = array(), $timestamp = true, $log = 'default')
		{
			if(is_bool($meta)){ // Treat as timestamp var
				$timestamp = $meta;
			}
			
			// Clear last entry;
			$this->entry = '';
			
			// Add timestamp
			if($timestamp){
				$this->entry = '[' . date($this->timestamp_format, time()) . ']: ';
			}
			
			// Add meta data, if available
			if(is_array($meta) && count($meta)){
				foreach($meta as $m){
					$this->entry .= '[' . $m . ']';
				}
				$this->entry .= ' - ';
			}
			
			// Add content and linebreak
			$this->entry .= $entry . "\n";
			
			if($this->log_status && is_string($log)){
				
				$fp = @fopen($this->logs[$log],'a');

				if (!$fp)
				{
					$this->log_status = self::LOG_FAILED;
					throw new LogException('Can\'t open log file: ' . $log);
				}

				fwrite($fp, $this->entry);
				fclose($fp);
			}
		}
		
		/**	
		 * clearLog function
		 * -------------
		 * Clears the log entirely
		 */
		
		public function clearLog($log = 'default')
		{
			$fp = @fopen($this->logs[$log],'w');
			if (!$fp) throw new LogException('Can\'t open log file: ' . $log);
		}
		
		/**	
		 * lastEntry function
		 * -------------
		 * Clears the log entirely
		 */
		
		public function lastEntry()
		{
			return $this->entry;
		}
		
		/**	
		 * deactivateLog function
		 * -------------
		 * deactivates logging
		 */
		
		public function deactivateLog()
		{
			$this->log_status = self::LOG_INACTIVE;
		}
		
		/**	
		 * activateLog function
		 * -------------
		 * activates logging
		 */
		
		public function activateLog()
		{
			$this->log_status = self::LOG_ACTIVE;
		}
			
	}
	
?>