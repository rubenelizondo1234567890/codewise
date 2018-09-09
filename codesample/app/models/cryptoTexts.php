<?php
namespace models;

use services\model;

/**
 * cryptoTexts model
 * 
 *
 */
class cryptoTexts extends model
{

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string")
     */
    protected $content;
	
	function __construct($em)
	{
		parent::__construct($em, get_class($this)); //Injecting the Entity manager so we use always the same object for all models

	}


    /**
     * Get todo
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set todo
     *
     * @param string $todo
     *
     * @return void
     */
    public function setTitle()
    {
        $this->title = "Crypto Challenge";
        return true;
    }

    /**
     * Get todoDescription
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set todo
     *
     * @param string $todo
     *
     * @return void
     */
    public function setContent()
    {
        $this->content = "
		<h3>Intro</h3>
		<p>
			During World War II, Alan Turing (who is considered the father of modern computing) used computational
			analysis, and created the ﬁrst computer to decrypt German messages. Given a key, the computer could
			decrypt messages at an alarming pace.
			You are provided a set of plain text ﬁles:  encrypted.txt ,  encrypted_hard.txt , and  plain.txt .
			You are to provide a project that decrypts  encrypted.txt , using  plain.txt  as a base. The
			plain.txt  ﬁle contains the literary works of William Shakespeare. There are various language patterns to
			create a computational algorithm for various types of analysis.
		</p>
		<p><strong>Files were uploaded to {root}/cipher-challenge/ directory in this server<strong></p>
		<br />
		<h3>Rules</h3>
		<p>
			<ul>
				<li>
					You can use a 1 for 1 type of algorithm. Which means, an uppercase character is the same as a lowercase character.
				</li>
				<li>
					Punctuation is punctuation, there is no decryption needed on these characters.
				</li>
				<li>
					Spaces are spaces, there is no decryption needed on these either.
				</li>
				<li>
					You may use any language you are comfortable with.
				</li>
				<li>
					There are no extra symbols used for the cipher.
				</li>
				<li>
					You may keep or remove the Project Gutenberg text in  plain.txt . It has very little impact on the result.
				</li>
			</ul>
		</p><br />
		<h3>Basics</h3>
		<p>
			<ul>
				<li>
					<h4>Find Key for first file.</h4>
					<ul>
						<li>The algorithm is based on pattern recognizion</li>
						<li>1st, the system preprocess the files, removing empty lines and converting all characters to lower case.</li>
						<li>2nd, we start the analysis considering that we already know that the encrypted text is part of the non encrypted one.</li>
						<li>3rd, this means that we instruct the computer to look for Chapter titles or similar. Number of words, length of words and punctuation must match.</li>
						<li>4th, once locating this, we analyze the next line, it must match number of words, length of words and punctuation.</li>
						<li>5th, once locating these 2 lines, we analyze a 3rd next line, it must match number of words, length of words and punctuation.</li>
						<li>6th, at this moment, we should have a small paragraph containing equivalent words and we use them to build the equivalent alphabet.</li>
					</ul>
					<h4>Dechiper File</h4>
					<ul>
						<li>Get key.</li>
						<li>Process first encrypted file and write decrypted text in new file.</li>
					</ul>
				</li>
			</ul>
		</p>
		";
		return true;
    }
}
