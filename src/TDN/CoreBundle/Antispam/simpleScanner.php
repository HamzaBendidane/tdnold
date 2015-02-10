<?php

namespace TDN\CoreBundle\Antispam;

class simpleScanner {

	private $blackWords = array('xanax','valium','viagra','loans','diazepam','clonazepam','oxycodone','lorazepam','zolpidem','sexcam',' medecin.gyneco@hotmail.fr','moncler','lacosteschuhe','thomassabo','sacamain', 'pascher', 'bourse','argent','maillot','louboutin','vuitton','canada goose');
	
	private $blackURLs = array('religion', 'burberry', 'vuitton','hermes', 'philmass', 'longchamp', 'bottesugg', 'outletchristianlouboutin', 'bourse', 'argent', 'maillot', 'u7buy');

	private $blackCountries = array('CN','RU', 'US');

	private $IP_Addr = array('14.102.253.242','14.147.x.x','14.150.72.x','23.
	92.80.25','23.238.x.x','27.150.x.x','27.153.x.x','27.159.x.x','31.41.217.96','36.250.x.
	x','37.46.80.170','37.59.28.42','37.59.32.148','37.187.x.x','37.233.27.142','41.32.127.206','41.79.x.x','41.86.227.22','41.86.234.x','41.86.235.x',
	'41.224.44.242','41.216.58.72','59.95.178.11','59.58.x.x','59.60.x.x','62.210.x.x','67.50.75.18','68.68.99.x','72.4
	6.x.x','74.91.19.211','76.164.x.x','81.91.229.207','87.119.221.70','91.121.170.197','91.200.12.118','91.2
	07.6.70','91.207.7.x','91.236.x.x','92.222.239.56','93.10.27.49','93.115.94.85','94.23.5.222','94.23.6.124','94.23.12.169','94.23.238.222','95.211
	.33.219','96.46.12.x','96.47.x.x','108.186.192.x','108.186.196.x','109.175.8.174','110.77.233.140','110.82.132.138','110.84
	.24.56','110.86.x.x','110.89.x.x','110.90.246.107','112.2.x.x','112.5.x.x','116.21.6
	4.x','117.26.x.x','117.30.136.33','120.37.x.x','120.40.156.141','125.70.13
	4.34','125.78.x.x','125.85.13.21','130.193.24.135','140.237.x.x','142.0.136.x','142.4.215.148','142.54.176.138','162.244.13.x','173.208.182.74','183.5.141.244','183.1
	38.165.207','186.95.32.44','188.64.61.132','188.143.x.x','192.74.240.x','1
	93.109.199.x','198.27.82.x','201.209.x.x','202.105.61.164','202.138.125.21
	1','208.177.76.15','213.215.59.122','213.238.175.10','216.151.137.x','216
	.244.86.130','216.99.146.x','220.132.19.136','222.77.x.x');

	private $keys = "#proventil|praziquantel|phenergan|accutane|kors|oakley|replica|baidu|tramadol|smoketip|dapoxetine|semenax|cialis|proactol|outletchristianlouboutin|daisy|DAISY|06.?70.?15.?67.?38|dofus|MMOPRG|money|loans|loan|bestfinance|loveinapparel|baidu234|glasses|wintrade|wewinwin|(shoes(\s)+online)|xanax|lorazepam|zolpidem|gametrailers|thisis50|diazepam|clonazepam|valium|([^a-z]ugg[^a-z])|moncler|bitcomet|oxycodone|perdollar|(([Aa]mazing|[Bb]est|[Gg]reat).+(post|topic|writing).+(yet|honest|truly|surely))|(^(<a[^<]+<\a>\s*)+$)|travail\s+[àa]\s+domicile|argent facile|devenir\s+trader]|faire\s+de\s+l\s+argent|\[url=http|[aeiou][0-9]\s|canada\sgoose|babyliss|Nike|Vuitton|[Ll]ouboutin|outlet|uggs\sboots|north\sface#i";

	private $validesAntiSpam = array('2', 'deux', '1+1');

	protected function isBlackDomain ($ip) {

		$remote = explode('.', $ip);
		if (count($remote) == 4) {
			foreach ($this->IP_Addr as $_ref) {
				$modele = explode('.', $_ref);
				$_match = true;
				for ($i = 0; $i < 4; $i++) {
					if (($modele[$i] !== 'x') && ($modele[$i] != $remote[$i])) {
						$_match = false;
						break;
					}
				}
				if ($_match) break;
			}			
		} else return false;

		return $_match ? $ip : false;
	}

	protected function ipCountry($ip)
	{
		// Géolocalisation IP
		try {
			$details = json_decode(file_get_contents("http://ipinfo.io/".$ip));
			if (in_array($details->country, $this->blackCountries)) {
				return array(0, $details->country, $details->city);
			} else {
				return array(1, $details->country, $details->city);
			}			
		} catch (\Exception $e) {
			return array (1, 'Inconnu', 'Inconnu');
		}
	}

	protected function noVoyelles ($texte)
	{
		$err = preg_match('/[BCDFGHJKLMNPQRSTVWXZbcdfghjklmnpqrstvwxz]{5,}/', $texte, $matches);
		if (!empty($matches)) {
			return $matches[0];
		} else {
			return false;
		}

	}

	protected function linkTraces ($texte)
	{
		$serie = implode("|", $this->blackWords);
		$keywords = "#<a[^>]+>.*?(".$serie.")[^<]*</a>#iU"; 
		$urlFragment = '#(http|https|ftp)://[^\s]*('.$serie.')([0-9a-z/\.\-_]|=\n)*#i';
		if (preg_match($urlFragment, strtolower($texte), $segments) != 0) {
			return "Nom de domaine : ".$segments[0];
		} else return false;
		
	}

	protected function stopWords ($texte)
	{
		if (preg_match($this->keys, strtolower($texte), $segments) != 0) {
			return "RegExp : ".$segments[0];
		} else {
			return false;
		}
	}

	protected function remoteAddr ($IP)
	{
		if (in_array($IP, $this->IP_Addr)) {
			return $IP;
		} else {
			return false;
		}
	}

    /**
     * Compte les URL de $text.
     *
     * @param string $text
     */
    private function countLinks($text)
    {
        $err = preg_match_all(
            '#(http|https|ftp)://([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?#i',
            $text,
            $matches);
         
        return count($matches[0]);
    }
     
    /**
     * Compte les e-mails de $text.
     *
     * @param string $text
     */
    private function countMails($text)
    {
        preg_match_all(
            '#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#i',
            $text,
            $matches);
         
        return count($matches[0]);
    }

    /**
     * Regarde si le commentaire contient du texte.
     *
     * @param string $text
     */
    private function isVide($text)
    {
        return (strlen($text) == 0);
    }

    private function isNotValidAntiSpam($reponse)
    {
    	if (is_null($reponse) || in_array($reponse, $this->validesAntiSpam)) {
    		return false;
    	} else {
			$pattern = "/([A-Za-z]+\s?)/";
    		$err = preg_match_all($pattern, $reponse, $matches);
    		if (count($matches[1]) > 1) {
    			return 100;
    		} else {
    			return 40;
    		}
    	}
    }

	public function scan ($texte, $IP = NULL, $antispam = NULL)
	{
		$score = 0;
		$fails = array();

		$test = $this->isVide($texte);
		if ($test) {
			$score += 500;
			$fails['vide'] = 'Message vide';
			$fails['faux texte'] = '';
		}
		$test = $this->isNotValidAntiSpam($antispam);
		if ($test) {
			$score += $test;
			$fails['antispam'] = $antispam;
		}
		$test = $this->isBlackDomain($IP);
		if ($test) {
			$score += 100;
			$fails['domaine IP'] = $test;
		};
		$test = $this->noVoyelles($texte);
		if ($test) {
			$score += 80;
			$fails['faux texte'] = $test;
		};
		$test = ($this->countLinks($texte) > 1);
		if ($this->countLinks($texte) > 1) {
			$score += 40;
			$fails['nombre de liens'] = $test;
		};
		$test = $this->stopWords($texte.' '.$antispam);
		if ($test) {
			$score += 80;
			$fails['mots interdits'] = $test;
		};
		$test = $this->linkTraces($texte);
		if ($test) {
			$score += 80;
			$fails['liens suspects'] = $test;
		};
		$test = $this->ipCountry($IP);
		if ($test[0] === 0) {
			$score += 40;
			$fails['pays émetteur'] = $test[1];
			$fails['geoIP'] = '';
		} else {
			$fails['geoIP'] = $test[2].' ('.$test[1].')';
		}

		switch (count($fails)) {
			case 1:
				return array('statut' => 'VALIDE', 'fails' => $fails, 'score' => $score);
				break;

			case 2:
				if ($score < 50) {
					return array('statut' => 'SUSPECT', 'fails' => $fails, 'score' => $score);
				} else {
					return array('statut' => 'SPAM', 'fails' => $fails, 'score' => $score);
				}
			
			default:
				return array('statut' => 'SPAM', 'fails' => $fails, 'score' => $score);
				break;
		}
	}	
}