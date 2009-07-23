<?php
	$path_to_simpletest = 'simpletest/1.0.1alpha3/';
	$path_to_wideimage_lib = '../lib/';
	
	error_reporting(E_ALL);
	define('WI_LIB_PATH', realpath($path_to_wideimage_lib) . DIRECTORY_SEPARATOR);
	
	require_once($path_to_simpletest . '/unit_tester.php');
	require_once($path_to_simpletest . '/mock_objects.php');
	require_once($path_to_simpletest . '/reporter.php');
	include('test.env.php');
	
	function collect_tests($dir, $test)
	{
		$di = new DirectoryIterator($dir);
		foreach ($di as $file)
			if ($file->isDir() && (substr($file->getFilename(), 0, 1) != '.'))
				collect_tests($dir . '/' . $file->getFilename(), $test);
			elseif (preg_match('/\.test\.php$/', $file->getFilename()))
			{
				echo "Found test: {$dir}/{$file->getFilename()}\n";
				$test->addTestFile($dir . '/' . $file->getFilename());
			}
	}
	
	$test = new GroupTest('WideImage tests');
	collect_tests(dirname(__FILE__), $test);
	$test->run(new TextReporter());	
?>