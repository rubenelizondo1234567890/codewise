<?php

namespace codewise\Bundle\LoyaltyBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Challenge
 *
 */
class LoyaltyChallenge
{

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("id")
     */
    protected $id;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    protected $name;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("sku")
     */
    protected $sku;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("summary")
     */
    protected $summary;

    /**
     * @var text
     * @JMS\Type("string")
     * @JMS\SerializedName("webDescription")
     */
    protected $webDescription;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("webDisclaimer")
     */
    protected $webDisclaimer;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("webImage")
     */
    protected $webImage;

    /**
     * @var text
     * @JMS\Type("string")
     * @JMS\SerializedName("emailDescription")
     */
    protected $emailDescription;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("emailDisclaimer")
     */
    protected $emailDisclaimer;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("emailImage")
     */
    protected $emailImage;

    /**
     * @var text
     * @JMS\Type("string")
     * @JMS\SerializedName("zioskDescription")
     */
    protected $zioskDescription;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("zioskDisclaimer")
     */
    protected $zioskDisclaimer;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("zioskImage")
     */
    protected $zioskImage;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("sequence")
     */
    protected $sequence;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("minPoints")
     */
    protected $minPoints;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("maxPoints")
     */
    protected $maxPoints;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("earnLimit")
     */
    protected $earnLimit;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("offerLimit")
     */
    protected $offerLimit;

    /**
     * @var \DateTime
     * @JMS\Type ("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("startDate")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @JMS\Type ("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("endDate")
     */
    protected $endDate;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("startDelay")
     */
    protected $startDelay;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("duration")
     */
    protected $duration;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("slug")
     */
    protected $slug;

    /**
     * @var boolean
     * @JMS\Type ("boolean")
     * @JMS\SerializedName("active")
     */
    protected $active;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("pointLevel1")
     */
    protected $pointLevel1;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("pointLevel2")
     */
    protected $pointLevel2;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("pointLevel3")
     */
    protected $pointLevel3;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("pointLevel4")
     */
    protected $pointLevel4;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("pointLevel5")
     */
    protected $pointLevel5;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("staleHoldout")
     */
    protected $staleHoldout;

    /**
     * @var boolean
     * @JMS\Type ("boolean")
     * @JMS\SerializedName("exclude")
     */
    private $exclude = 0;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("multiplier")
     */
    protected $multiplier;

    /**
     * @var integer
     * @JMS\Type ("integer")
     * @JMS\SerializedName("campaignId")
     */
    protected $campaignId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("category")
     */
    protected $category;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("categoryId")
     */
    protected $categoryId;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("rewardId")
     */
    protected $rewardId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("rewardName")
     */
    protected $rewardName;

    /**
     * @var integer
     * @JMS\Type("integer")
     * @JMS\SerializedName("rewardValidDuration")
     */
    protected $rewardValidDuration;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("challengeRequirements0")
     */
    protected $challengeRequirements0;

    /**
     * @var loyaltyChallengeRequirements
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengeRequirements")
     * @JMS\SerializedName("loyaltyChallengeRequirements0")
     */
    protected $loyaltyChallengeRequirements0;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("challengeRequirements1")
     */
    protected $challengeRequirements1;

    /**
     * @var loyaltyChallengeRequirements
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengeRequirements")
     * @JMS\SerializedName("loyaltyChallengeRequirements1")
     */
    protected $loyaltyChallengeRequirements1;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("challengeRequirements2")
     */
    protected $challengeRequirements2;

    /**
     * @var loyaltyChallengeRequirements
     * @JMS\Type("codewise\Bundle\LoyaltyBundle\Model\LoyaltyChallengeRequirements")
     * @JMS\SerializedName("loyaltyChallengeRequirements2")
     */
    protected $loyaltyChallengeRequirements2;

    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();

        $this->startDate = $this->startDate->modify('+2 day');
        $this->endDate = $this->endDate->modify('+3 day');
        
        // Modifying this as requested by GR
        // THey want a dropdown select to choose category
        //$this->categoryId = 1;

        // Removing Point Levels from the form as requested by GR
        // But keeping all th logic for backward compability or future needs
        $this->pointLevel1 = null;
        $this->pointLevel2 = null;
        $this->pointLevel3 = null;
        $this->pointLevel4 = null;
        $this->pointLevel5 = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function getWebDescription()
    {
        return $this->webDescription;
    }

    public function setWebDescription($webDescription)
    {
        $this->webDescription = $webDescription;
    }

    public function getWebDisclaimer()
    {
        return $this->webDisclaimer;
    }

    public function setWebDisclaimer($webDisclaimer)
    {
        $this->webDisclaimer = $webDisclaimer;
    }

    public function getWebImage()
    {
        return $this->webImage;
    }

    public function setWebImage($webImage)
    {
        $this->webImage = $webImage;
    }

    public function getEmailDescription()
    {
        return $this->emailDescription;
    }

    public function setEmailDescription($emailDescription)
    {
        $this->emailDescription = $emailDescription;
    }

    public function getEmailDisclaimer()
    {
        return $this->emailDisclaimer;
    }

    public function setEmailDisclaimer($emailDisclaimer)
    {
        $this->emailDisclaimer = $emailDisclaimer;
    }

    public function getEmailImage()
    {
        return $this->emailImage;
    }

    public function setEmailImage($emailImage)
    {
        $this->emailImage = $emailImage;
    }

    public function getZioskDescription()
    {
        return $this->zioskDescription;
    }

    public function setZioskDescription($zioskDescription)
    {
        $this->zioskDescription = $zioskDescription;
    }

    public function getZioskDisclaimer()
    {
        return $this->zioskDisclaimer;
    }

    public function setZioskDisclaimer($zioskDisclaimer)
    {
        $this->zioskDisclaimer = $zioskDisclaimer;
    }

    public function getZioskImage()
    {
        return $this->zioskImage;
    }

    public function setZioskImage($zioskImage)
    {
        $this->zioskImage = $zioskImage;
    }

    public function getSequence()
    {
        return $this->sequence;
    }

    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    public function getStartDelay()
    {
        return $this->startDelay;
    }

    public function setStartDelay($startDelay)
    {
        $this->startDelay = $startDelay;
    }

    public function getStaleHoldout()
    {
        return $this->staleHoldout;
    }

    public function setStaleHoldout($staleHoldout)
    {
        $this->staleHoldout = $staleHoldout;
    }

    public function getMinPoints()
    {
        return $this->minPoints;
    }

    public function setMinPoints($minPoints)
    {
        $this->minPoints = $minPoints;
    }

    public function getMaxPoints()
    {
        return $this->maxPoints;
    }

    public function setMaxPoints($maxPoints)
    {
        $this->maxPoints = $maxPoints;
    }

    public function getEarnLimit()
    {
        return $this->earnLimit;
    }

    public function setEarnLimit($earnLimit)
    {
        $this->earnLimit = $earnLimit;
    }

    public function getOfferLimit()
    {
        return $this->offerLimit;
    }

    public function setOfferLimit($offerLimit)
    {
        $this->offerLimit = $offerLimit;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getPointLevel1()
    {
        return $this->pointLevel1;
    }

    public function setPointLevel1($pointLevel1)
    {
        $this->pointLevel1 = $pointLevel1;
    }

    public function getPointLevel2()
    {
        return $this->pointLevel2;
    }

    public function setPointLevel2($pointLevel2)
    {
        $this->pointLevel2 = $pointLevel2;
    }

    public function getPointLevel3()
    {
        return $this->pointLevel3;
    }

    public function setPointLevel3($pointLevel3)
    {
        $this->pointLevel3 = $pointLevel3;
    }

    public function getPointLevel4()
    {
        return $this->pointLevel4;
    }

    public function setPointLevel4($pointLevel4)
    {
        $this->pointLevel4 = $pointLevel4;
    }

    public function getPointLevel5()
    {
        return $this->pointLevel5;
    }

    public function setPointLevel5($pointLevel5)
    {
        $this->pointLevel5 = $pointLevel5;
    }

    public function setExclude($exclude){
        $this->exclude = $exclude;
    }

    public function getExclude(){
        return $this->exclude;
    }

    public function getMultiplier(){
        return $this->multiplier;
    }

    public function setMultiplier($multiplier){
        $this->multiplier =$multiplier;
    }

    public function getCampaignId(){
        return $this->campaignId;
    }

    public function setCampaignId($campaignId){
        $this->campaignId = $campaignId;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getCategoryId(){
        return $this->categoryId;
    }

    public function setCategoryId($categoryId){
        $this->categoryId = $categoryId;
    }

    public function getRewardId(){
        return $this->rewardId;
    }

    public function setRewardId($rewardId){
        $this->rewardId = $rewardId;
    }

    public function getRewardName(){
        return $this->rewardName;
    }

    public function setRewardName($rewardName){
        $this->rewardName = $rewardName;
    }

    public function getRewardValidDuration(){
        return $this->rewardValidDuration;
    }

    public function setRewardValidDuration($rewardValidDuration){
        $this->rewardValidDuration = $rewardValidDuration;
    }

    public function getChallengeRequirements0(){
        return $this->challengeRequirements0;
    }

    public function setChallengeRequirements0($challengeRequirements0){
        $this->challengeRequirements0 = $challengeRequirements0;
    }

    public function getLoyaltyChallengeRequirements0(){
        return $this->loyaltyChallengeRequirements0;
    }

    public function setLoyaltyChallengeRequirements0(LoyaltyChallengeRequirements $loyaltyChallengeRequirements0){
        $this->loyaltyChallengeRequirements0 = $loyaltyChallengeRequirements0;
    }
    
    public function getChallengeRequirements1(){
        return $this->challengeRequirements1;
    }

    public function setChallengeRequirements1($challengeRequirements1){
        $this->challengeRequirements1 = $challengeRequirements1;
    }

    public function getLoyaltyChallengeRequirements1(){
        return $this->loyaltyChallengeRequirements1;
    }

    public function setLoyaltyChallengeRequirements1(LoyaltyChallengeRequirements $loyaltyChallengeRequirements1){
        $this->loyaltyChallengeRequirements1 = $loyaltyChallengeRequirements1;
    }
    
    public function getChallengeRequirements2(){
        return $this->challengeRequirements2;
    }

    public function setChallengeRequirements2($challengeRequirements2){
        $this->challengeRequirements2 = $challengeRequirements2;
    }

    public function getLoyaltyChallengeRequirements2(){
        return $this->loyaltyChallengeRequirements2;
    }

    public function setLoyaltyChallengeRequirements2(LoyaltyChallengeRequirements $loyaltyChallengeRequirements2){
        $this->loyaltyChallengeRequirements2 = $loyaltyChallengeRequirements2;
    }

}
