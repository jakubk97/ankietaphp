<?php
$f = fopen("semafor", "w");
flock($f, LOCK_EX);

$rawdata = file_get_contents("php://input");
$daneJSON = json_decode($rawdata, true);
$ok = true;

if ($daneJSON == null) {
	$wynik = array('rez' => false, 'kod' => 1, 'bo' => 'zły format');
	$ok = false;
}


if ($ok) {
	if (isset($daneJSON['id'])) {
		if (isset($daneJSON['opcja'])) {
			$co = (int) round($daneJSON['opcja'] * 1);
			switch ($co) {
				case 0:
					$wynik = zad0($daneJSON);
					break;
				case 1:
					$wynik = zad1($daneJSON);
					break;
				case 2:
					$wynik = zad2($daneJSON);
					break;
				case 3:
					$wynik = zad3($daneJSON);
					break;
				case 4:
					$wynik = zad4($daneJSON);
					break;
				case 5:
					$wynik = odczytajWzor($daneJSON);
					break;
				case 6:
					$wynik = odczytajWybor($daneJSON);
					break;
				case 7:
					$wynik = odczytajKolor($daneJSON);
					break;
				case 8:
					$wynik = odczytajDate($daneJSON);
					break;
				case 9:
					$wynik = zad9($daneJSON);
					break;
				case 10:
					$wynik = zad10($daneJSON);
					break;

				default:
					$wynik = array('rez' => false, 'kod' => 3, 'bo' => 'nieznane polecenie');
			}
		} else {
			$wynik = array('rez' => false, 'kod' => 1, 'bo' => 'brak polecenia');
		}
	} else {
		$wynik = array('rez' => false, 'kod' => 1, 'bo' => 'brak id');
	}
}


$wynikS = json_encode($wynik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
echo $wynikS;



flock($f, LOCK_UN);
fclose($f);

function zad0($daneJSON)
{
	if (isset($daneJSON['id'])) {
		$id = $daneJSON['id'];
		if (isset($daneJSON['wzor']) && isset($daneJSON['wybor']) && isset($daneJSON['kolor']) && isset($daneJSON['data'])) {
			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
				if ($plik == null) $plik = array();
			} else {
				$plik = array();
			}

			$post_data = array('wzor' => $daneJSON['wzor'], 'wybor' => $daneJSON['wybor'], 'kolor' => $daneJSON['kolor'], 'data' => $daneJSON['data']);

			file_put_contents("zapisplikow5583678dzgd786geg/$id",
				json_encode($post_data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
			);
			return array('rez' => true, 'kod' => 101, 'bo' => 'ok');
		} else {
			return array('rez' => false, 'kod' => 5, 'bo' => 'Brak poprawnych danych!');
		}
	} else {
		return array('rez' => false, 'kod' => 2, 'bo' => 'brak id');
	}
}

function zad1($daneJSON)
{
	if (isset($daneJSON['id'])) {
		$id = $daneJSON['id'];
		if (isset($daneJSON['wzor'])) {
			if (file_exists("zapisplikow5583678dzgd786geg/$id.wzor")) {
				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.wzor"), true);
				if ($plik == null) $plik = array();
			} else {
				$plik = array();
			}

			$post_data = array('wzor' => $daneJSON['wzor']);


			file_put_contents(
				"zapisplikow5583678dzgd786geg/$id.wzor",
				json_encode($post_data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
			);
			return array('rez' => true, 'kod' => 101, 'bo' => 'ok');
		} else {
			return array('rez' => false, 'kod' => 5, 'bo' => 'brak wzoru');
		}
	} else {
		return array('rez' => false, 'kod' => 2, 'bo' => 'brak id');
	}
}

function zad2($daneJSON)
{
	if (isset($daneJSON['id'])) {
		$id = $daneJSON['id'];
		if (isset($daneJSON['wybor'])) {
			if (file_exists("zapisplikow5583678dzgd786geg/$id.wybor")) {
				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.wybor"), true);
				if ($plik == null) $plik = array();
			} else {
				$plik = array();
			}

			$post_data = array('wybor' => $daneJSON['wybor']);


			file_put_contents(
				"zapisplikow5583678dzgd786geg/$id.wybor",
				json_encode($post_data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
			);
			return array('rez' => true, 'kod' => 101, 'bo' => 'ok');
		} else {
			return array('rez' => false, 'kod' => 5, 'bo' => 'brak wyboru');
		}
	} else {
		return array('rez' => false, 'kod' => 2, 'bo' => 'brak id');
	}
}

function zad3($daneJSON)
{
	if (isset($daneJSON['id'])) {
		$id = $daneJSON['id'];
		if (isset($daneJSON['kolor'])) {
			if (file_exists("zapisplikow5583678dzgd786geg/$id.kolor")) {
				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.kolor"), true);
				if ($plik == null) $plik = array();
			} else {
				$plik = array();
			}

			$post_data = array('kolor' => $daneJSON['kolor']);

			file_put_contents(
				"zapisplikow5583678dzgd786geg/$id.kolor",
				json_encode($post_data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
			);
			return array('rez' => true, 'kod' => 101, 'bo' => 'ok');
		} else {
			return array('rez' => false, 'kod' => 5, 'bo' => 'brak koloru');
		}
	} else {
		return array('rez' => false, 'kod' => 2, 'bo' => 'brak id');
	}
}

function zad4($daneJSON)
{
	if (isset($daneJSON['id'])) {
		$id = $daneJSON['id'];
		if (isset($daneJSON['data'])) {
			if (file_exists("zapisplikow5583678dzgd786geg/$id.data")) {
				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.data"), true);
				if ($plik == null) $plik = array();
			} else {
				$plik = array();
			}

			$post_data = array('data' => $daneJSON['data']);

			file_put_contents(
				"zapisplikow5583678dzgd786geg/$id.data",
				json_encode($post_data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
			);
			return array('rez' => true, 'kod' => 101, 'bo' => 'ok');
		} else {
			return array('rez' => false, 'kod' => 5, 'bo' => 'brak daty');
		}
	} else {
		return array('rez' => false, 'kod' => 2, 'bo' => 'brak id');
	}
}

function odczytajWzor( $daneJSON )
{
	$id=$daneJSON['id'];
	if(file_exists("zapisplikow5583678dzgd786geg/$id.wzor"))
	{		
		$plik=json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.wzor"),true);
		$id=$plik['id'] ?? '';
		$wzor=$plik['wzor'] ?? '';
		return array('rez'=>true, 'kod'=>201, 'bo'=>'ok', 'dane'=>$wzor);
	}
	else
	{
		return array('rez'=>false, 'kod'=>5, 'bo'=>'brak danych dla id');
	}
}

function odczytajWybor( $daneJSON )
{
	$id=$daneJSON['id'];
	if(file_exists("zapisplikow5583678dzgd786geg/$id.wybor"))
	{		
		$plik=json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.wybor"),true);
		$id=$plik['id'] ?? '';
		$wybor=$plik['wybor'] ?? '';
		return array('rez'=>true, 'kod'=>201, 'bo'=>'ok', 'dane'=>$wybor);
	}
	else
	{
		return array('rez'=>false, 'kod'=>5, 'bo'=>'brak danych dla id');
	}
}

function odczytajKolor( $daneJSON )
{
	$id=$daneJSON['id'];
	if(file_exists("zapisplikow5583678dzgd786geg/$id.kolor"))
	{		
		$plik=json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.kolor"),true);
		$id=$plik['id'] ?? '';
		$kolor=$plik['kolor'] ?? '';
		return array('rez'=>true, 'kod'=>201, 'bo'=>'ok', 'dane'=>$kolor);
	}
	else
	{
		return array('rez'=>false, 'kod'=>5, 'bo'=>'brak danych dla id');
	}
}

function odczytajDate( $daneJSON )
{
	$id=$daneJSON['id'];
	if(file_exists("zapisplikow5583678dzgd786geg/$id.data"))
	{		
		$plik=json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id.data"),true);
		$id=$plik['id'] ?? '';
		$data=$plik['data'] ?? '';
		return array('rez'=>true, 'kod'=>201, 'bo'=>'ok', 'dane'=>$data);
	}
	else
	{
		return array('rez'=>false, 'kod'=>5, 'bo'=>'brak danych dla id');
	}
}

// function zad1($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['napis1']) && isset($daneJSON['napis2'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null) $plik = array();
// 			} else {
// 				$plik = array();
// 			}

// 			$post_data = array('tekst1' => $daneJSON['napis1'], 'tekst2' => $daneJSON['napis2']);

// 			//$post_data = json_encode(array('item' => $post_data), JSON_FORCE_OBJECT);

// 			//$plik['napis']=$daneJSON['napis'] . "    " . $daneJSON['napis'];


// 			file_put_contents(
// 				"zapisplikow5583678dzgd786geg/$id",
// 				json_encode($post_data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
// 			);
// 			return array('rez' => true, 'kod' => 101, 'bo' => 'ok');
// 		} else {
// 			return array('rez' => false, 'kod' => 5, 'bo' => 'brak napis1 i napis2');
// 		}
// 	} else {
// 		return array('rez' => false, 'kod' => 2, 'bo' => 'brak id');
// 	}
// }

// function zad2($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['liczba'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}
// 			$plik['liczba'] = $daneJSON['liczba'];
// 			file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 			return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Brak podanej liczby');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }



// function zad3($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['wybrana_nazwa'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}
// 			$plik['wybrana_nazwa'] = $daneJSON['wybrana_nazwa'];
// 			file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 			return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Brak podanej nazwy');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }
// function zad4($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['podpowiedz'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}
// 			$plik['podpowiedz'] = $daneJSON['podpowiedz'];
// 			file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 			return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Brak podanej podpowiedzi');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }

// function zad5($daneJSON)
// {
// 	$nr = $daneJSON['nr'] ?? '';
// 	if (file_exists("zapisplikow5583678dzgd786geg/wzor$nr")) {
// 		$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/wzor{$nr}"), true);
// 		if ($plik == null) {
// 			return array('rez' => false, 'kod' => 5, 'bo' => 'zły format w pliku wyb');
// 		} else {
// 			return array('rez' => true, 'kod' => 202, 'bo' => 'ok', 'dane' => $plik);
// 		}
// 	} else {
// 		return array('rez' => false, 'kod' => 5, 'bo' => 'brak wyborów');
// 	}
// }

// function zad6($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['HEX'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}

// 			list($r, $g, $b) = sscanf($daneJSON['HEX'], "#%02x%02x%02x");

// 			$plik['KOLOR']['RED'] = $r;
// 			$plik['KOLOR']['GREEN'] = $g;
// 			$plik['KOLOR']['BLUE'] = $b;

// 			file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 			return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Bład podanego koloru');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }
// function zad7($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['data'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}
// 			$plik['data'] = $daneJSON['data'];
// 			if (isRealDate($daneJSON['data'])) {
// 				file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 				return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 			} else {
// 				return array('status' => false, 'kod' => 8, 'bo' => 'podany ciag nie jest data! FORMAT POPRAWNY TO: "Y-m-d"');
// 			}
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Brak podanej daty');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }

// function isRealDate($date)
// {
// 	if (false === strtotime($date)) {
// 		return false;
// 	}
// 	list($year, $month, $day) = explode('-', $date);
// 	return checkdate($month, $day, $year);
// }

// function zad8($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['godzina'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}
// 			if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $daneJSON['godzina'])) {
// 				$plik['czas'] = $daneJSON['godzina'];

// 				$plik['czas'] = array(
// 					'GODZINA' => $daneJSON['godzina']
// 				);
// 				file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 				return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 			} else {
// 				file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 				return array('status' => false, 'kod' => 8, 'bo' => 'Błąd - podany ciąg nie jest godziną HH:MM!');
// 			}
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Błąd podanego czasu');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }
// function zad9($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['od']) && isset($daneJSON['do'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				$plik = array();
// 			}
// 			if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $daneJSON['od']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $daneJSON['do'])) {
// 				$plik['przedzial']['OD'] = $daneJSON['od'];
// 				$plik['przedzial']['DO'] = $daneJSON['do'];

// 				file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 				return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 			} else {
// 				file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 				return array('status' => false, 'kod' => 8, 'bo' => 'Błąd - podany ciąg nie jest godziną HH:MM!');
// 			}
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Błąd podanego przedzialu');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }



// // <form id="checkboxes">
// // <li><input type="checkbox" name="keywords[]"  value="option1" title="option1" /></li>
// // <li><input type="checkbox" name="keywords[]"  value="option2" title="option2" /></li>
// // <li><input type="checkbox" name="keywords[]"  value="option3" title="option3" /></li>
// // <li><input type="checkbox" name="keywords[]"  value="option4" title="option4" /></li>
// // <li><input type="submit" name="submit" class="search" /></li>
// // </form>

// // <script type="text/javascript">
// // $(document).ready(function(){
// //     $(".search").click(function()
// //     {           
// //         $.post("parser.php", $("form#checkboxes").serialize(), 
// //         function(data)
// //         {        
// //             $.each(data, function()
// //             {   
// //                 $("div#result").append("<li class='arrow'><a href='parser.php?id=" + this.id + "'>" + this.title + "</a></li>");
// //             });
// //             $("div#jsonContent").show();
// //         });
// //     });
// // });
// // </script>


// function zad10($daneJSON)
// {
// 	if (isset($daneJSON['id'])) {
// 		$id = $daneJSON['id'];
// 		if (isset($daneJSON['keywords'])) {
// 			if (file_exists("zapisplikow5583678dzgd786geg/$id")) {
// 				$plik = json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"), true);
// 				if ($plik == null)
// 					$plik = array();
// 			} else {
// 				foreach ($_POST['keywords'] as $keyword) {
// 					$plik['Wybrane'] += $keyword . " ";

// 					file_put_contents("zapisplikow5583678dzgd786geg/$id", json_encode($plik, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
// 					return array('status' => true, 'kod' => 101, 'bo' => 'ok');
// 				}
// 			}
// 		} else {
// 			return array('status' => false, 'kod' => 5, 'bo' => 'Błąd podanego przedzialu');
// 		}
// 	} else {
// 		return array('status' => false, 'kod' => 2, 'bo' => 'Brak nazwy pliku');
// 	}
// }



// // function zapiszNapis( $daneJSON )
// // {
// // 	if(isset($daneJSON['id']))
// // 	{
// // 		$id=$daneJSON['id'];
// // 		if(isset($daneJSON['napis']))
// // 		{
// // 			if(file_exists("4073e4bf57b9e327a0ff30bc0d34d5bd/$id"))
// // 			{
// // 				$plik=json_decode(file_get_contents("4073e4bf57b9e327a0ff30bc0d34d5bd/$id"),true);
// // 				if($plik==null) $plik=array();
// // 			}
// // 			else
// // 			{
// // 				$plik=array();
// // 			}
			
// // 			$post_data = array('id' => '1','imie' => '2','nazwisko' => '3',);
	
// // 			//$post_data = json_encode(array('item' => $post_data), JSON_FORCE_OBJECT);
			
// // 			//$plik['napis']=$daneJSON['napis'] . "    " . $daneJSON['napis'];
			

// // 			file_put_contents("4073e4bf57b9e327a0ff30bc0d34d5bd/$id",
// // 			json_encode($post_data, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE+JSON_UNESCAPED_SLASHES));			
// // 			return array('rez'=>true, 'kod'=>101, 'bo'=>'ok');
// // 		}
// // 		else
// // 		{
// // 			return array('rez'=>false, 'kod'=>5, 'bo'=>'brak napis');
// // 		}
// // 	}
// // 	else
// // 	{
// // 		return array('rez'=>false, 'kod'=>2, 'bo'=>'brak id');
// // 	}
// // }


// function odczytajNapis( $daneJSON )
// {
// 	$id=$daneJSON['id'];
// 	if(file_exists("zapisplikow5583678dzgd786geg/$id"))
// 	{		
// 		$plik=json_decode(file_get_contents("zapisplikow5583678dzgd786geg/$id"),true);
// 		$id=$plik['id'] ?? '';
// 		$imie=$plik['imie'] ?? '';
// 		$nazwisko=$plik['nazwisko'] ?? '';
// 		return array('rez'=>true, 'kod'=>201, 'bo'=>'ok', 'dane'=>"ID: " . $id . " IMIE: " . $imie . " NAZWISKO: " . $nazwisko);
		
// 	}
// 	else
// 	{
// 		return array('rez'=>false, 'kod'=>5, 'bo'=>'brak danych dla id');
// 	}
// }

// function podajWzory($daneJSON )
// {
// 	$nr=$daneJSON['nr'] ?? 1;
// 	if(file_exists("danedof/wybor$nr"))
// 	{
// 		$plik=json_decode(file_get_contents("danedof/wybor{$nr}"),true);
// 		if($plik==null)
// 		{
// 			return array('rez'=>false, 'kod'=>5, 'bo'=>'zły format w pliku wyb');
// 		}
// 		else
// 		{		
// 			return array('rez'=>true, 'kod'=>202, 'bo'=>'ok', 'dane'=>$plik);
// 		}
// 	}
// 	else
// 	{
// 		return array('rez'=>false, 'kod'=>5, 'bo'=>'brak wyborów');
// 	}
// }
