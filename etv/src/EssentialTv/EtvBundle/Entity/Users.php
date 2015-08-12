<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=100, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=50, nullable=false)
     */
    private $userPassword;

    /**
     * @var integer
     *
     * @ORM\Column(name="google_user_id", type="integer", nullable=false)
     */
    private $googleUserId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_hash", type="string", length=200, nullable=false)
     */
    private $userHash;

    /**
     * @var string
     *
     * @ORM\Column(name="user_status", type="string", nullable=false)
     */
    private $userStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="user_verification", type="string", nullable=false)
     */
    private $userVerification;

    /**
     * @var string
     *
     * @ORM\Column(name="user_first_name", type="string", length=50, nullable=false)
     */
    private $userFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_middle_name", type="string", length=50, nullable=false)
     */
    private $userMiddleName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_last_name", type="string", length=50, nullable=false)
     */
    private $userLastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_DOB", type="date", nullable=false)
     */
    private $userDob;

    /**
     * @var string
     *
     * @ORM\Column(name="user_gender", type="string", nullable=false)
     */
    private $userGender;

    /**
     * @var string
     *
     * @ORM\Column(name="user_aboutme", type="string", length=500, nullable=false)
     */
    private $userAboutme;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_image", type="string", length=500, nullable=true)
     */
    private $userImage;

    /**
     * @var string
     *
     * @ORM\Column(name="user_street_address", type="text", nullable=false)
     */
    private $userStreetAddress;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_street_address2", type="text", nullable=true)
     */
    private $userStreetAddress2;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_country", type="integer", nullable=false)
     */
    private $userCountry;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_city", type="integer", nullable=false)
     */
    private $userCity;

    /**
     * @var text
     *
     * @ORM\Column(name="user_zip", type="text", nullable=true)
     */
    private $userZip;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="user_state", type="text", nullable=true)
     */
    private $userState;

    /**
     * @var string
     *
     * @ORM\Column(name="user_phone", type="string", length=20, nullable=false)
     */
    private $userPhone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_last_login", type="datetime", nullable=false)
     */
    private $userLastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;


    public $userRole;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_facebook_link", type="string", length=20, nullable=true)
     */
    private $userFacebookLink;
    
     /**
     * @var string
     *
     * @ORM\Column(name="user_facebook_link", type="string", length=20, nullable=true)
     */
    private $userTwitterLink;
    
     /**
     * @var string
     *
     * @ORM\Column(name="user_facebook_link", type="string", length=20, nullable=true)
     */
    private $userGoogleLink;
    
    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return Users
     */
    
    
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return Users
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set googleUserId
     *
     * @param integer $googleUserId
     * @return Users
     */
    public function setGoogleUserId($googleUserId)
    {
        $this->googleUserId = $googleUserId;

        return $this;
    }

    /**
     * Get googleUserId
     *
     * @return integer 
     */
    public function getGoogleUserId()
    {
        return $this->googleUserId;
    }

    /**
     * Set userHash
     *
     * @param string $userHash
     * @return Users
     */
    public function setUserHash($userHash)
    {
        $this->userHash = $userHash;

        return $this;
    }

    /**
     * Get userHash
     *
     * @return string 
     */
    public function getUserHash()
    {
        return $this->userHash;
    }

    /**
     * Set userStatus
     *
     * @param string $userStatus
     * @return Users
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;

        return $this;
    }

    /**
     * Get userStatus
     *
     * @return string 
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * Set userVerification
     *
     * @param string $userVerification
     * @return Users
     */
    public function setUserVerification($userVerification)
    {
        $this->userVerification = $userVerification;

        return $this;
    }

    /**
     * Get userVerification
     *
     * @return string 
     */
    public function getUserVerification()
    {
        return $this->userVerification;
    }

    /**
     * Set userFirstName
     *
     * @param string $userFirstName
     * @return Users
     */
    public function setUserFirstName($userFirstName)
    {
        $this->userFirstName = $userFirstName;

        return $this;
    }

    /**
     * Get userFirstName
     *
     * @return string 
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    /**
     * Set userMiddleName
     *
     * @param string $userMiddleName
     * @return Users
     */
    public function setUserMiddleName($userMiddleName)
    {
        $this->userMiddleName = $userMiddleName;

        return $this;
    }

    /**
     * Get userMiddleName
     *
     * @return string 
     */
    public function getUserMiddleName()
    {
        return $this->userMiddleName;
    }

    /**
     * Set userLastName
     *
     * @param string $userLastName
     * @return Users
     */
    public function setUserLastName($userLastName)
    {
        $this->userLastName = $userLastName;

        return $this;
    }

    /**
     * Get userLastName
     *
     * @return string 
     */
    public function getUserLastName()
    {
        return $this->userLastName;
    }

    /**
     * Set userDob
     *
     * @param \DateTime $userDob
     * @return Users
     */
    public function setUserDob($userDob)
    {
        $this->userDob = $userDob;

        return $this;
    }

    /**
     * Get userDob
     *
     * @return \DateTime 
     */
    public function getUserDob()
    {
        return $this->userDob;
    }

    /**
     * Set userGender
     *
     * @param string $userGender
     * @return Users
     */
    public function setUserGender($userGender)
    {
        $this->userGender = $userGender;

        return $this;
    }

    /**
     * Get userGender
     *
     * @return string 
     */
    public function getUserGender()
    {
        return $this->userGender;
    }

    /**
     * Set userAboutme
     *
     * @param string $userAboutme
     * @return Users
     */
    public function setUserAboutme($userAboutme)
    {
        $this->userAboutme = $userAboutme;

        return $this;
    }

    /**
     * Get userAboutme
     *
     * @return string 
     */
    public function getUserAboutme()
    {
        return $this->userAboutme;
    }

    /**
     * Set userStreetAddress
     *
     * @param string $userStreetAddress
     * @return Users
     */
    public function setUserStreetAddress($userStreetAddress)
    {
        $this->userStreetAddress = $userStreetAddress;

        return $this;
    }

    /**
     * Get userStreetAddress
     *
     * @return string 
     */
    public function getUserStreetAddress()
    {
        return $this->userStreetAddress;
    }
    
    
    
    /**
     * Set userStreetAddress
     *
     * @param string $userStreetAddress
     * @return Users
     */
    public function setUserStreetAddress2($userStreetAddress2)
    {
        $this->userStreetAddress2 = $userStreetAddress2;

        return $this;
    }

    /**
     * Get userStreetAddress
     *
     * @return string 
     */
    public function getUserStreetAddress2()
    {
        return $this->userStreetAddress2;
    }

    /**
     * Set userCountry
     *
     * @param integer $userCountry
     * @return Users
     */
    public function setUserCountry($userCountry)
    {
        $this->userCountry = $userCountry;

        return $this;
    }

    /**
     * Get userCountry
     *
     * @return integer 
     */
    public function getUserCountry()
    {
        return $this->userCountry;
    }

    /**
     * Set userCity
     *
     * @param integer $userCity
     * @return Users
     */
    public function setUserCity($userCity)
    {
        $this->userCity = $userCity;

        return $this;
    }

    /**
     * Get userCity
     *
     * @return integer 
     */
    public function getUserCity()
    {
        return $this->userCity;
    }
    
       /**
     * Set userState
     *
     * @param string $userState
     * @return Users
     */
    public function setUserState($userState)
    {
        $this->userState = $userState;

        return $this;
    }

    /**
     * Get userState
     *
     * @return string
     */
    public function getUserState()
    {
        return $this->userState;
    }
    
    /**
     * Set userImage
     *
     * @param integer $userImage
     * @return Users
     */
    public function setUserImage($userImage)
    {
        $this->userImage = $userImage;

        return $this;
    }

    /**
     * Get userZip
     *
     * @return integer 
     */
    public function getUserImage()
    {
        return $this->userImage;
    }

    /**
     * Set userZip
     *
     * @param integer $userZip
     * @return Users
     */
    public function setUserZip($userZip)
    {
        $this->userZip = $userZip;

        return $this;
    }

    /**
     * Get userZip
     *
     * @return integer 
     */
    public function getUserZip()
    {
        return $this->userZip;
    }

    /**
     * Set userPhone
     *
     * @param string $userPhone
     * @return Users
     */
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    /**
     * Get userPhone
     *
     * @return string 
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * Set userLastLogin
     *
     * @param \DateTime $userLastLogin
     * @return Users
     */
    public function setUserLastLogin($userLastLogin)
    {
        $this->userLastLogin = $userLastLogin;

        return $this;
    }

    /**
     * Get userLastLogin
     *
     * @return \DateTime 
     */
    public function getUserLastLogin()
    {
        return $this->userLastLogin;
    }
    
    
     /**
     * Set userRole
     *
     * @param \String $setUserRole
     * @return Users
     */
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return \String 
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @var integer
     */
    private $userLastViewedEpisodeId;

    /**
     * @var \DateTime
     */
    private $userLastViewedEpisodeDatetime;


    /**
     * Set userLastViewedEpisodeId
     *
     * @param integer $userLastViewedEpisodeId
     * @return Users
     */
    public function setUserLastViewedEpisodeId($userLastViewedEpisodeId)
    {
        $this->userLastViewedEpisodeId = $userLastViewedEpisodeId;

        return $this;
    }

    /**
     * Get userLastViewedEpisodeId
     *
     * @return integer 
     */
    public function getUserLastViewedEpisodeId()
    {
        return $this->userLastViewedEpisodeId;
    }

    /**
     * Set userLastViewedEpisodeDatetime
     *
     * @param \DateTime $userLastViewedEpisodeDatetime
     * @return Users
     */
    public function setUserLastViewedEpisodeDatetime($userLastViewedEpisodeDatetime)
    {
        $this->userLastViewedEpisodeDatetime = $userLastViewedEpisodeDatetime;

        return $this;
    }

    /**
     * Get userLastViewedEpisodeDatetime
     *
     * @return \DateTime 
     */
    public function getUserLastViewedEpisodeDatetime()
    {
        return $this->userLastViewedEpisodeDatetime;
    }
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_profile_picture", type="text", nullable=true)
     */
    private $userProfilePicture;
    
    /**
     * Set userProfilePicture
     *
     * @param string $userProfilePicture
     * @return Users
     */
    public function setUserProfilePicture($userProfilePicture)
    {
        $this->userProfilePicture = $userProfilePicture;

        return $this;
    }

    /**
     * Get userProfilePicture
     *
     * @return string 
     */
    public function getUserProfilePicture()
    {
        return $this->userProfilePicture;
    }
    
    
    /**
     * Set userFacebookLink
     *
     * @param string $userFacebookLink
     * @return Users
     */
    public function setUserFacebookLink($userFacebookLink)
    {
        $this->userFacebookLink = $userFacebookLink;

        return $this;
    }

    /**
     * Get userFacebookLink
     *
     * @return string
     */
    public function getUserFacebookLink()
    {
        return $this->userFacebookLink;
    }
    
    /**
     * Set userTwitterLink
     *
     * @param string $userTwitterLink
     * @return Users
     */
    public function setUserTwitterLink($userTwitterLink)
    {
        $this->userTwitterLink = $userTwitterLink;

        return $this;
    }

    /**
     * Get userTwitterLink
     *
     * @return string
     */
    public function getUserTwitterLink()
    {
        return $this->userTwitterLink;
    }
    
    /**
     * Set userGoogleLink
     *
     * @param string $userGoogleLink
     * @return Users
     */
    public function setUserGoogleLink($userGoogleLink)
    {
        $this->userGoogleLink = $userGoogleLink;

        return $this;
    }

    /**
     * Get userGoogleLink
     *
     * @return string
     */
    public function getUserGoogleLink()
    {
        return $this->userGoogleLink;
    }
    
    /**
     * @var string
     */
    private $userSocialId;
    /**
     * Set userSocialId
     *
     * @param string $userSocialId
     * @return Users
     */
    public function setUserSocialId($userSocialId)
    {
        $this->userSocialId = $userSocialId;

        return $this;
    }

    /**
     * Get userSocialId
     *
     * @return string
     */
    public function getUserSocialId()
    {
        return $this->userSocialId;
    }
    /**
     * @var string
     */
    private $userSocialType;
     /**
     * Set userSocialType
     *
     * @param string $userSocialType
     * @return Users
     */
    public function setUserSocialType($userSocialType)
    {
        $this->userSocialType = $userSocialType;

        return $this;
    }

    /**
     * Get userSocialType
     *
     * @return string
     */
    public function getUserSocialType()
    {
        return $this->userSocialType;
    }
}
