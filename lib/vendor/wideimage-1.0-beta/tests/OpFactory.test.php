<?php
	/**
    This file is part of WideImage.
		
    WideImage is free software; you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation; either version 2.1 of the License, or
    (at your option) any later version.
		
    WideImage is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.
		
    You should have received a copy of the GNU Lesser General Public License
    along with WideImage; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  **/
	
	class wioMyOperation
	{
	}
	
	class OpFactoryTest extends UnitTestCase
	{
		function testFactoryReturnsCached()
		{
			$op1 = wiOpFactory::get('Mirror');
			$op2 = wiOpFactory::get('Mirror');
			$this->assertIdentical($op1, $op2);
		}
		
		function testNoOperation()
		{
			try
			{
				$op = wiOpFactory::get('NoSuchOp');
				$this->fail("Exception expected.");
			}
			catch (wiUnknownImageOperationException $e)
			{
				$this->pass();
			}
		}
		
		function testUserDefinedOp()
		{
			$op = wiOpFactory::get('MyOperation');
			$this->assertTrue($op instanceof wioMyOperation);
		}
	}
?>