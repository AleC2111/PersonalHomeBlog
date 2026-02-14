<?php 
class PostData{
    private int $postId;
    private string $title;
    private string $content;
    private string $category;
    private array $tags;
    private DateTime $date;
    private int $relatedUserId;

    function __construct(){
        $this->postId=0;
        $this->title="";
        $this->content="";
        $this->category="";
        $this->tags=[];
        $this->date=new DateTime();
        $this->relatedUserId=0;
    }
    private function utilIsValueNull($text){
        if(is_null($text) || $text=="") throw new Error("Error: No se permiten valores nulos");
    }
    private function utilSanitizeText($text, $dbConnection){
        return pg_escape_string($dbConnection, $text);
    }
    private function utilValidateTags($tags, $dbConnection){
        foreach($tags as $item){
            $item = $this->utilSanitizeText($item, $dbConnection);
        }
        return $tags;
    }
    private function utilIsNegative($number){
        if($number <= 0){
            throw new Error("Error: No se permite un valor negativo o 0");
        }
        return $number;
    }
    private function utilIsDateBefore($newDate){
        if($newDate < $this->date || !strtotime($newDate)){
            throw new Error("Error: La fecha nueva no puede ser anterior o no es una fecha");
        }
        return $newDate;
    }
    
    public function setPostId($postId){
        $this->postId = $this->utilIsNegative($postId);
    }
    public function getPostId(){
        return $this->postId;
    }

    public function setTitle($title, $dbConnection){
        $this->utilIsValueNull($title);
        $this->title = $this->utilSanitizeText($title, $dbConnection);
    }
    public function getTitle(){
        return $this->title;
    }

    public function setContent($content, $dbConnection){
        $this->utilIsValueNull($content);
        $this->content = $this->utilSanitizeText($content, $dbConnection);
    }
    public function getContent(){
        return $this->content;
    }

    public function setCategory($category, $dbConnection){
        $this->utilIsValueNull($category);
        $this->category = $this->utilSanitizeText($category, $dbConnection);
    }
    public function getCategory(){
        return $this->category;
    }

    public function setTags($tags, $dbConnection){
        $this->utilIsValueNull($tags);
        $this->tags = $this->utilValidateTags($tags, $dbConnection);
    }
    public function addTag($newTag, $dbConnection){
        $this->tags[] = $this->utilSanitizeText($newTag, $dbConnection);
    }
    public function getTags(){
        return $this->tags;
    }

    public function setDate($newDate){
        $this->utilIsValueNull($newDate);
        $this->date = $this->utilIsDateBefore($newDate);
    }
    public function getDate(){
        return $this->date->format('Y-m-d H:i:s');
    }

    public function setUserId($relatedUserId){
        $this->relatedUserId = $this->utilIsNegative($relatedUserId);
    }
    public function getUserId(){
        return $this->relatedUserId;
    }
}
?>