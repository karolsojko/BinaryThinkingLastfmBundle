<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\User;

/**
 * UserTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class UserTest extends ModelTestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockUserResponse');
        $user = User::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\User', 
                $user, 'object created is not an instance of User');
        $this->assertNotEmpty($user->getName(), 'name is empty');
        $this->assertNotEmpty($user->getRealName(), 'real name is empty');
        $this->assertNotEmpty($user->getUrl(), 'url is empty');
        $this->assertNotEmpty($user->getWeight(), 'weight is empty');
        $this->assertNotEmpty($user->getImages(), 'images are empty');
    }
}
