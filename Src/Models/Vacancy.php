<?php
namespace Src\Models;

class Vacancy extends AbstractModel
{
    /**
     * Title of the vacancy
     *
     * @var string
     */
    protected $title;

    /**
     * Description of the vacancy
     *
     * @var string
     */
    protected $description;

    /**
     * Link of the vacancy
     *
     * @var string
     */
    protected $link;

    /**
     * Instantiates an existing object
     *
     * @param array $data
     */
    public function instantiate($data)
    {
        $this->id           = (int)$data['id'];
        $this->title        = $data['titel'];
        $this->description  = $data['functie_omschrijving']['p'];
        $this->link         = $data['sollicitatie_link'];
    }

    /**
     * Get the title of the vacancy
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the description of the vacancy
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the link of the vacancy
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * get all the vacancies from the xml file
     *
     * @return Vacancy[]
     */
    public function all()
    {
        $xmlVacancies = $this->getXmlData(dirname(__FILE__) . '/invoices.xml');
        $vacancies = [];
        foreach ($xmlVacancies->vacature as $xmlVacancy) {
            // Make json from xml so we can instantiate it
            $vacancyData = json_decode(json_encode($xmlVacancy),TRUE);
            $vacancy     = new self($this->container);
            $vacancy->instantiate($vacancyData);
            $vacancies[] = $vacancy;
        }

        return $vacancies;
    }
}
