<?php

namespace CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity(repositoryClass="CvBundle\Repository\PersonneRepository")
 */
class Personne
{







    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * Personne constructor.
     * @param string $nom
     * @param string $prenom
     * @param int $age
     * @param string $path
     */
   /* public function __construct($nom, $prenom, $age, $path)
    {
        $this->nom = ucfirst($nom);
        $this->prenom = ucfirst($prenom);
        $this->age = $age;

        $dirp =  dirname(dirname(dirname(dirname(__DIR__)))).'/web/images/'.$path;

        if (file_exists($dirp))
           $this->path = $path;
        else
        $this->path ='user.png';
    }*/


    public function __construct(){}



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Personne
     */
    public function setNom($nom)
    {
        $this->nom = ucfirst($nom);

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = ucfirst($prenom);

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Personne
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Personne
     */
    public function setPath($path)
    {
        $dirp =  dirname(dirname(dirname(dirname(__DIR__)))).'/web/images/'.$path;

        if (file_exists($dirp))
            $this->path = $path;
        else
            $this->path ='user.png';

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}

