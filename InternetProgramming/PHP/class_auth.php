<?php
/*~ class_auth.php
 *
 * Classe de Autenticação v0.1
 *   
 *  By Giancarlo Gil Ottaviani Raduan ( graduan at gmail.com ~ @giradu )
 *  Visit my website and become my friend at http://raduan.net
 *  Release Date: The day that Brazil won Côte d'Ivoire WCSA 2010 ( 20/06/2010 )
 *
 *
 * Requires / Requer: PHP, AdoDB and MySQL 
 *
 * Special Thanks / Agradecimentos Especiais:
 *  Apache, PHP, MySQL, PHP AdoDB, AS Komodo, my daughter Lais and wife Simone
 *
 *
 * Portuguese
 *  Licença: Distribuido sobre a Lesser General Public Licence (LGPL)
 *  http://www.gnu.org/copyleft/lesser.html
 *
 * Este programa é distribuído na esperança que será útil - Sem
 * Qualquer Garantia; sem mesmo a garantia implícita de Comerciabilidade ou
 * Adequação a uma Finalidade Particular;
 *
 * English:
 *  License: Distributed under the Lesser General Public License (LGPL)
 *  http://www.gnu.org/copyleft/lesser.html
 *
 * This program is distributed in the hope that it will be useful - Without
 * Any Warranty; without even the implied warranty of Merchantability or
 * Fitness For a Particular Purpose;
 *
 *
 * SQL Drop:

CREATE TABLE IF NOT EXISTS `sessions` (
  `session` varchar(32) NOT NULL,
  `usr_id` mediumint(9) NOT NULL DEFAULT '0',
  `usr_name` varchar(32) NOT NULL,
  `data` datetime DEFAULT NULL,
  `usr_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`session`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `senha` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;


 * PHP Ex:

<?php  
require('class_auth.php');

$a = new Auth();

$p = $_POST;
$r = $_GET;

if ( $r['op'] == 'logout' ) { $a->logout(); echo "logout"; }

if ( $p ) {
     if ( $a->Login($p['usuario'], $p['senha']) ) { echo "logado / logged"; } else { echo "falha / fail"; }
    }

//$a->AddUser('usuario', 'senha');
//$a->RemUser('usuario');

if ( $a->isAuth() ) { echo "<a href=\"?op=logout\">logout</a>"; }
else {
     echo "<form action=\"index.php\" method=\"POST\">\r\n";
     echo "<input type=\"text\" name=\"usuario\" value=\"usuario\">\r\n";
     echo "<input type=\"text\" name=\"senha\" value=\"senha\">\r\n";
     echo "<input type=\"submit\" name=\"Logar\">\r\n";
     echo "</form>\r\n";
    }

echo $a->getSession() . '<br />';
echo $a->getUID() . '<br />';
echo $a->getUsuario() . '<br />';

*/

class Auth {
     
     var $s_tbl = 'sessions'; // tab: sessões
     var $s_sid = 'session';  // col: sessão
     var $s_uid = 'usr_id';   // col: id do usuário
     var $s_unm = 'usr_name'; // col: nome do usuario
     var $s_udl = 'data';     // col: data do logon do usuário
     var $s_uip = 'usr_ip';   // col: ip do usuário 
     var $u_tbl = 'usuarios'; // *tab: usuários
     var $u_uid = 'id';       // col: id
     var $u_usr = 'usuario';  // col: usuario
     var $u_snh = 'senha';    // col: senha
     
     var $c_snh = 2; // criptografia de senha, 0 = nada, 1 = md5, 2 = sha1
     
     var $adodb_dsn   = 'mysql://root:xxxxxxxx@localhost/hostpre_site'; // driver://usuario:senha@host/banco
     var $adodb_path  = '/usr/share/php/adodb/'; // caminho do adodb
     
     var $db;
     
     function Auth () {
         require_once ($this->adodb_path . "adodb.inc.php");
         $this->db =& ADONewConnection($this->adodb_dsn);
         
         session_start();
        }
     
     function Login ($usr, $snh) {
         if ( $this->c_snh == 1 ) {
             $snh = md5($snh);
            }
         elseif ( $this->c_snh == 2 ) {
             $snh = sha1($snh);
            }
         
         $ip  = getenv("REMOTE_ADDR");
         
         $sql = "SELECT * FROM `" . $this->u_tbl . "` WHERE `" . $this->u_usr . "` = '$usr' AND `" . $this->u_snh . "` = '$snh' LIMIT 1;";
         $rs  = $this->db->Execute($sql);
         $cp  = $rs->FetchRow();
         
         if ( $cp[$this->u_usr] ) {
             $sql = "INSERT INTO `" . $this->s_tbl . "` (`" . $this->s_sid . "`, `" . $this->s_uid . "`, `" . $this->s_unm . "`, `" . $this->s_uip . "`, `" . $this->s_udl . "`) VALUES ('" . $this->getSession() . "', '" . $cp[$this->u_uid] . "', '" . $cp[$this->u_usr] . "', '" . $ip . "', FROM_UNIXTIME('" . time() . "'));";
             $this->db->Execute($sql);
             
             return true;
            }
         else {
             return false;
            }
        }
     
     function AddUser ($usr, $snh) {
         if ( $this->c_snh == 1 ) {
             $snh = md5($snh);
            }
         elseif ( $this->c_snh == 2 ) {
             $snh = sha1($snh);
            }
         
         $sql = "INSERT INTO `" . $this->u_tbl . "` (`" . $this->u_usr . "`, `" . $this->u_snh . "`) VALUES ('" . $usr . "', '" . $snh . "');";
         $this->db->Execute($sql);
        }
     
     function RemUser ($usr) {
         if ( $usr != NULL ) {
             $sql = "DELETE FROM `" . $this->u_tbl . "` WHERE `" . $this->u_usr . "` = '" . $usr . "' LIMIT 1;";
             $this->db->Execute($sql);
             
             $sql = "DELETE FROM `" . $this->s_tbl . "` WHERE `" . $this->s_unm . "` = '" . $usr . "';";
             $this->db->Execute($sql);
            }
        }     
     
     function Logout ($usr = '') {
         if ( $usr == NULL ) {
             $sql = "DELETE FROM `" . $this->s_tbl . "` WHERE `" . $this->s_sid . "` = '" . $this->getSession() . "' LIMIT 1;";
             $this->db->Execute($sql);
            }
         else {
             $sql = "DELETE FROM `" . $this->s_tbl . "` WHERE `" . $this->s_unm . "` = '" . $usr . "' LIMIT 1;";
             $rs = $this->db->Execute($sql);
            }
         session_regenerate_id(true);
        }
     
     function getSession () {
         return session_id();
        }
     
     function getUsuario () {
         $sql = "SELECT * FROM `" . $this->s_tbl . "` WHERE `" . $this->s_sid . "` = '" . $this->getSession() . "' LIMIT 1;";
         $rs = $this->db->Execute($sql);
         $cp = $rs->FetchRow();
         
         if ( $cp[$this->s_sid] ) {
             return $cp[$this->s_unm ];
            }
         else {
             return false;
            }
        }
     
     function getUID () {
         $sql = "SELECT * FROM `" . $this->s_tbl . "` WHERE `" . $this->s_sid . "` = '" . $this->getSession() . "' LIMIT 1;";
         $rs = $this->db->Execute($sql);
         $cp = $rs->FetchRow();
         
         if ( $cp[$this->s_sid] ) {
             return $cp[$this->s_uid];
            }
         else {
             return false;
            }
        }
     
     function isAuth() {
         $sql = "SELECT * FROM `" . $this->s_tbl . "` WHERE `" . $this->s_sid . "` = '" . $this->getSession() . "' LIMIT 1;";
         $rs = $this->db->Execute($sql);
         $cp = $rs->FetchRow();
         
         if ( $cp[$this->s_sid] ) {
             return true;
            }
         else {
             return false;
            }
        }
     
    }
?>