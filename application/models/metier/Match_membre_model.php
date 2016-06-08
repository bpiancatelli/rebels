<?php

class Match_membre_model extends CI_Model{

	private $idMatchMembre;
	private $idMembre;
	private $idMatch;
	private $pa;
	private $ab;
	private $hit;
	private $simpleHit;
	private $doubleHit;
	private $tripleHit;
	private $hr;
	private $roe;
	private $hbp;
	private $gofo;
	private $sac;
	private $bb;
	private $k;
	private $rbi;
	private $runs;
	private $sb;
	private $cs;

	public function __construct($idMatchMembre ='', $idMembre ='', $idMatch ='', $pa ='', $ab ='', $hit ='', $simpleHit ='', $doubleHit ='', $tripleHit ='', $hr ='', $roe ='', $hbp ='', $gofo ='', $sac ='', $bb ='', $k ='', $rbi ='', $runs ='', $sb ='', $cs =''){
		parent::__construct();
		$this->idMatchMembre = $idMatchMembre;
		$this->idMembre = $idMembre;
		$this->idMatch = $idMatch;
		$this->pa = $pa;
		$this->ab = $ab;
		$this->hit = $hit;
		$this->simpleHit = $simpleHit;
		$this->doubleHit = $doubleHit;
		$this->tripleHit = $tripleHit;
		$this->hr = $hr;
		$this->roe = $roe;
		$this->hbp = $hbp;
		$this->gofo = $gofo;
		$this->sac = $sac;
		$this->bb = $bb;
		$this->k = $k;
		$this->rbi = $rbi;
		$this->runs = $runs;
		$this->sb = $sb;
		$this->cs = $cs;
	}
	
	public function calculPA($simple,$double,$triple,$hr,$roe,$hbp,$gofo,$sac,$bb,$k){
    	$pa = $simple+$double+$triple+$hr+$roe+$hbp+$gofo+$sac+$bb+$k;
    	return $pa;
    }

    public function calculAB($pa,$hbp,$bb){
    	$ab = $pa-($hbp+$bb);
    	return $ab;
    }

    public function calculHits($simple,$double,$triple,$hr){
    	$h = $simple + $double + $triple + $hr;
    	return $h;
    }

    public function calculBBrat($bb,$pa){
    	if($pa > 0){
    		$bbrat = $bb/$pa;
    	}else{
            $bbrat = 0;
        }
    	return number_format($bbrat,3);
    }

    public function calculKrat($pa,$k){
    	if($pa > 0){
    		$krat = $k/$pa;
    	}else{
            $krat = 0;
        }

    	return number_format($krat,3);
    }

    public function calculAVG($ab,$h){
    	if($ab > 0){
    		$avg = $h/$ab;
    	}else{
            $avg = 0;
        }

    	return number_format($avg,3);
    }

    public function calculOBrat($ab,$h,$hbp,$bb){
    	if($ab > 0){
    		$obrat = ($h+$hbp+$bb)/($ab+$bb+$hbp);
    	}else{
            $obrat = 0;
        }
    	return number_format($obrat,3);
    }

    public function calculSLUGrat($ab,$simple,$double,$triple,$hr){
    	if($ab > 0){
    		$slugrat = ($simple + (2*$double) + (3*$triple) + (4*$hr))/$ab;
    	}else{
            $slugrat = 0;
        }
    	return number_format($slugrat,3);
    }

    public function calculSBrat($sb,$cs){
    	if($sb > 0){
    		$sbrat = $sb/($sb+$cs);
    	}else{
            $sbrat = 0;
        }
    	return number_format($sbrat,3);
    }




    /**
     * Gets the value of idMatchMembre.
     *
     * @return mixed
     */
    public function getIdMatchMembre()
    {
        return $this->idMatchMembre;
    }

    /**
     * Sets the value of idMatchMembre.
     *
     * @param mixed $idMatchMembre the id match membre
     *
     * @return self
     */
    public function setIdMatchMembre($idMatchMembre)
    {
        $this->idMatchMembre = $idMatchMembre;

        return $this;
    }

    /**
     * Gets the value of idMembre.
     *
     * @return mixed
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * Sets the value of idMembre.
     *
     * @param mixed $idMembre the id membre
     *
     * @return self
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Gets the value of idMatch.
     *
     * @return mixed
     */
    public function getIdMatch()
    {
        return $this->idMatch;
    }

    /**
     * Sets the value of idMatch.
     *
     * @param mixed $idMatch the id match
     *
     * @return self
     */
    public function setIdMatch($idMatch)
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    /**
     * Gets the value of pa.
     *
     * @return mixed
     */
    public function getPa()
    {
        return $this->pa;
    }

    /**
     * Sets the value of pa.
     *
     * @param mixed $pa the pa
     *
     * @return self
     */
    public function setPa($pa)
    {
        $this->pa = $pa;

        return $this;
    }

    /**
     * Gets the value of ab.
     *
     * @return mixed
     */
    public function getAb()
    {
        return $this->ab;
    }

    /**
     * Sets the value of ab.
     *
     * @param mixed $ab the ab
     *
     * @return self
     */
    public function setAb($ab)
    {
        $this->ab = $ab;

        return $this;
    }

    /**
     * Gets the value of hit.
     *
     * @return mixed
     */
    public function getHit()
    {
        return $this->hit;
    }

    /**
     * Sets the value of hit.
     *
     * @param mixed $hit the hit
     *
     * @return self
     */
    public function setHit($hit)
    {
        $this->hit = $hit;

        return $this;
    }

    /**
     * Gets the value of simpleHit.
     *
     * @return mixed
     */
    public function getSimpleHit()
    {
        return $this->simpleHit;
    }

    /**
     * Sets the value of simpleHit.
     *
     * @param mixed $simpleHit the simple hit
     *
     * @return self
     */
    public function setSimpleHit($simpleHit)
    {
        $this->simpleHit = $simpleHit;

        return $this;
    }

    /**
     * Gets the value of doubleHit.
     *
     * @return mixed
     */
    public function getDoubleHit()
    {
        return $this->doubleHit;
    }

    /**
     * Sets the value of doubleHit.
     *
     * @param mixed $doubleHit the double hit
     *
     * @return self
     */
    public function setDoubleHit($doubleHit)
    {
        $this->doubleHit = $doubleHit;

        return $this;
    }

    /**
     * Gets the value of tripleHit.
     *
     * @return mixed
     */
    public function getTripleHit()
    {
        return $this->tripleHit;
    }

    /**
     * Sets the value of tripleHit.
     *
     * @param mixed $tripleHit the triple hit
     *
     * @return self
     */
    public function setTripleHit($tripleHit)
    {
        $this->tripleHit = $tripleHit;

        return $this;
    }

    /**
     * Gets the value of hr.
     *
     * @return mixed
     */
    public function getHr()
    {
        return $this->hr;
    }

    /**
     * Sets the value of hr.
     *
     * @param mixed $hr the hr
     *
     * @return self
     */
    public function setHr($hr)
    {
        $this->hr = $hr;

        return $this;
    }

    /**
     * Gets the value of roe.
     *
     * @return mixed
     */
    public function getRoe()
    {
        return $this->roe;
    }

    /**
     * Sets the value of roe.
     *
     * @param mixed $roe the roe
     *
     * @return self
     */
    public function setRoe($roe)
    {
        $this->roe = $roe;

        return $this;
    }

    /**
     * Gets the value of hbp.
     *
     * @return mixed
     */
    public function getHbp()
    {
        return $this->hbp;
    }

    /**
     * Sets the value of hbp.
     *
     * @param mixed $hbp the hbp
     *
     * @return self
     */
    public function setHbp($hbp)
    {
        $this->hbp = $hbp;

        return $this;
    }

    /**
     * Gets the value of gofo.
     *
     * @return mixed
     */
    public function getGofo()
    {
        return $this->gofo;
    }

    /**
     * Sets the value of gofo.
     *
     * @param mixed $gofo the gofo
     *
     * @return self
     */
    public function setGofo($gofo)
    {
        $this->gofo = $gofo;

        return $this;
    }

    /**
     * Gets the value of sac.
     *
     * @return mixed
     */
    public function getSac()
    {
        return $this->sac;
    }

    /**
     * Sets the value of sac.
     *
     * @param mixed $sac the sac
     *
     * @return self
     */
    public function setSac($sac)
    {
        $this->sac = $sac;

        return $this;
    }

    /**
     * Gets the value of bb.
     *
     * @return mixed
     */
    public function getBb()
    {
        return $this->bb;
    }

    /**
     * Sets the value of bb.
     *
     * @param mixed $bb the bb
     *
     * @return self
     */
    public function setBb($bb)
    {
        $this->bb = $bb;

        return $this;
    }

    /**
     * Gets the value of k.
     *
     * @return mixed
     */
    public function getK()
    {
        return $this->k;
    }

    /**
     * Sets the value of k.
     *
     * @param mixed $k the k
     *
     * @return self
     */
    public function setK($k)
    {
        $this->k = $k;

        return $this;
    }

    /**
     * Gets the value of rbi.
     *
     * @return mixed
     */
    public function getRbi()
    {
        return $this->rbi;
    }

    /**
     * Sets the value of rbi.
     *
     * @param mixed $rbi the rbi
     *
     * @return self
     */
    public function setRbi($rbi)
    {
        $this->rbi = $rbi;

        return $this;
    }

    /**
     * Gets the value of runs.
     *
     * @return mixed
     */
    public function getRuns()
    {
        return $this->runs;
    }

    /**
     * Sets the value of runs.
     *
     * @param mixed $runs the runs
     *
     * @return self
     */
    public function setRuns($runs)
    {
        $this->runs = $runs;

        return $this;
    }

    /**
     * Gets the value of sb.
     *
     * @return mixed
     */
    public function getSb()
    {
        return $this->sb;
    }

    /**
     * Sets the value of sb.
     *
     * @param mixed $sb the sb
     *
     * @return self
     */
    public function setSb($sb)
    {
        $this->sb = $sb;

        return $this;
    }

    /**
     * Gets the value of cs.
     *
     * @return mixed
     */
    public function getCs()
    {
        return $this->cs;
    }

    /**
     * Sets the value of cs.
     *
     * @param mixed $cs the cs
     *
     * @return self
     */
    public function setCs($cs)
    {
        $this->cs = $cs;

        return $this;
    }
}