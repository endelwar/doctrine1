<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

/**
 * Doctrine_Sequence_Pgsql_TestCase
 *
 * @package     Doctrine
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @category    Object Relational Mapping
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision$
 */
class Doctrine_Sequence_Pgsql_TestCase extends Doctrine_UnitTestCase 
{
     public function testCurrIdExecutesSql() 
     {
        $this->sequence->currId('user');
        $q = 'SELECT last_value FROM user_seq';

        $this->assertEqual($this->adapter->pop(), $q);
    }
    public function testNextIdExecutesSql() 
    {
        $id = $this->sequence->nextId('user');

        $this->assertEqual($this->adapter->pop(), "SELECT NEXTVAL('user_seq')");

    }
    public function testLastInsertIdExecutesSql()
    {
        $this->sequence->lastInsertId('user');
        
        $this->assertEqual($this->adapter->pop(), "SELECT CURRVAL('user_seq')");
    }
}
