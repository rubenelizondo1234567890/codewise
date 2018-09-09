<?php
namespace models;

use services\model;

/**
 * todo Entity
 * Keeping doctrine like annotations for future development of ORM
 *
 * @ORM\Table(name="todo", indexes={@ORM\Index(name="wiki_page_cat_idx", columns={"wiki_parent_page_id", "wiki_cat_id"})})
 * @ORM\Entity
 */
class todo extends model
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, autoincrement=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="todo_name", type="string", nullable=false)
     */
    private $todoName;

    /**
     * @var string
     *
     * @ORM\Column(name="todo_description", type="string")
     */
    private $todoDescription;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_created", type="string", nullable=false)
     */
    private $date_modified;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="enum", nullable=false)
     */
    private $status;
	
	function __construct($em)
	{
		parent::__construct($em, get_class($this)); //Injecting the Entity manager so we use always the same object for all models

	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get todo
     *
     * @return string
     */
    public function getTodoName()
    {
        return $this->todoName;
    }

    /**
     * Set todo
     *
     * @param string $todo
     *
     * @return void
     */
    public function setTodoName(string $todoName)
    {
        $this->todo = $todoName;
    }

    /**
     * Get todoDescription
     *
     * @return string
     */
    public function getTodoDescription()
    {
        return $this->todoDescription;
    }

}
