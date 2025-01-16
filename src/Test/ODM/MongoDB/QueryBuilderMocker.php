<?php
/**
 * Simplified mocking for unit tests involving the Doctrine QueryBuilders.
 *
 * @author Michael Moussa <michael.moussa@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License
 */

namespace MMoussa\Doctrine\Test\ODM\MongoDB;

use MMoussa\Doctrine\Test\QueryBuilderMocker as BaseQueryBuilderMocker;
use PHPUnit\Framework\TestCase;

/**
 * Mocks Doctrine MongoDB ODM QueryBuilder fluent interface invocations for use in PHPUnit tests.
 * \Doctrine\ODM\MongoDB\Query\Query
 * @method addAnd
 * @method addManyToSet
 * @method addNor
 * @method addOr
 * @method addToSet
 * @method all
 * @method count
 * @method distanceMultiplier
 * @method distinct
 * @method eagerCursor
 * @method elemMatch
 * @method equals
 * @method exclude
 * @method exists
 * @method field
 * @method finalize
 * @method find
 * @method findAndRemove
 * @method findAndUpdate
 * @method geoIntersects
 * @method geoNear
 * @method geoWithin
 * @method geoWithinBox
 * @method geoWithinCenter
 * @method geoWithinCenterSpher
 * @method geoWithinPolygon
 * @method getNewObj
 * @method getQuery
 * @method group
 * @method gt
 * @method gte
 * @method hint
 * @method hydrate
 * @method immortal
 * @method in
 * @method inc
 * @method includesReferenceTo
 * @method insert
 * @method limit
 * @method lt
 * @method lte
 * @method map
 * @method mapReduce
 * @method mapReduceOptions
 * @method maxDistance
 * @method mod
 * @method multiple
 * @method near
 * @method nearSphere
 * @method not
 * @method notEqual
 * @method notIn
 * @method out
 * @method popFirst
 * @method popLast
 * @method prime
 * @method pull
 * @method pullAll
 * @method push
 * @method pushAll
 * @method range
 * @method reduce
 * @method references
 * @method refresh
 * @method remove
 * @method rename
 * @method requireIndexes
 * @method returnNew
 * @method select
 * @method selectElemMatch
 * @method selectSlice
 * @method set
 * @method setNewObj
 * @method setOnInsert
 * @method setQueryArray
 * @method setReadPreference
 * @method size
 * @method skip
 * @method slaveOkay
 * @method snapshot
 * @method sort
 * @method spherical
 * @method type
 * @method unsetField
 * @method update
 * @method upsert
 * @method where
 * @method withinBox
 * @method withinCenter
 * @method withinCenterSphere
 * @method withinPolygon
 */
class QueryBuilderMocker extends BaseQueryBuilderMocker
{
    /**
     * Methods supported for the query builder mocker.
     *
     * @var array
     */
    public static $supportedMethods = array(
        'addAnd',
        'addManyToSet',
        'addNor',
        'addOr',
        'addToSet',
        'all',
        'count',
        'distanceMultiplier',
        'distinct',
        'eagerCursor',
        'elemMatch',
        'equals',
        'exclude',
        'execute',
        'exists',
        'field',
        'finalize',
        'find',
        'findAndRemove',
        'findAndUpdate',
        'geoIntersects',
        'geoNear',
        'geoWithin',
        'geoWithinBox',
        'geoWithinCenter',
        'geoWithinCenterSphere',
        'geoWithinPolygon',
        'getNewObj',
        'getOneOrNullResult'
        'getQuery',
        'getSingleResult',
        'group',
        'gt',
        'gte',
        'hint',
        'hydrate',
        'immortal',
        'in',
        'inc',
        'includesReferenceTo',
        'insert',
        'limit',
        'lt',
        'lte',
        'map',
        'mapReduce',
        'mapReduceOptions',
        'maxDistance',
        'mod',
        'multiple',
        'near',
        'nearSphere',
        'not',
        'notEqual',
        'notIn',
        'out',
        'popFirst',
        'popLast',
        'prime',
        'pull',
        'pullAll',
        'push',
        'pushAll',
        'range',
        'reduce',
        'references',
        'refresh',
        'remove',
        'rename',
        'requireIndexes',
        'returnNew',
        'select',
        'selectElemMatch',
        'selectSlice',
        'set',
        'setOnInsert',
        'setNewObj',
        'setQueryArray',
        'setReadPreference',
        'size',
        'skip',
        'slaveOkay',
        'snapshot',
        'sort',
        'spherical',
        'type',
        'unsetField',
        'update',
        'upsert',
        'where',
        'withinBox',
        'withinCenter',
        'withinCenterSphere',
        'withinPolygon',
    );

    /**
     * Initializes the TestCase and creates a mock QueryBuilder and Query for later use.
     *
     * @param TestCase $testCase
     */
    public function __construct(TestCase $testCase)
    {
        $this->testCase = $testCase;
        $this->queryBuilder = $testCase->getMockBuilder('Doctrine\ODM\MongoDB\Query\Builder')
            ->disableOriginalConstructor()
            ->getMock();
        $this->query = $testCase->getMockBuilder('Doctrine\ODM\MongoDB\Query\Query')
            ->disableOriginalConstructor()
            ->setMethods(array('execute', 'getSingleResult', 'getOneOrNullResult'))
            ->getMock();
    }

    /**
     * {@inheritDoc}
     *
     * @param array|null $args
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function execute(array $args)
    {
        $invocationMocker = $this->query->expects($this->testCase->once())
            ->method('execute');

        // QueryBuilderMocker "execute" parameter is the intended final result to return.
        if (count($args) > 0) {
            $invocationMocker->will($this->testCase->returnValue($args[0]));
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param array|null $args
     * @return $this
     */
    protected function getSingleResult(array $args)
    {
        $invocationMocker = $this->query->expects($this->testCase->once())->method('getSingleResult');

        // QueryBuilderMocker "getSingleResult" parameter is the intended final result to return.
        if (count($args) > 0) {
            $invocationMocker->will($this->testCase->returnValue($args[0]));
        }

        return $this;
    }

    /**
     * @param array|null $args
     * @return $this
     */
    protected function getOneOrNullResult(array $args)
    {
        $invocationMocker = $this->query->expects($this->testCase->once())->method('getOneOrNullResult');

        // QueryBuilderMocker "getOneOrNullResult" parameter is the intended final result to return.
        if (count($args) > 0) {
            $invocationMocker->will($this->testCase->returnValue($args[0]));
        }

        return $this;
    }
}
