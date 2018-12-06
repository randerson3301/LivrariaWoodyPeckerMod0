<?php
//upload de imagem
                            $file = $_FILES["fleFoto"]["name"];

                            //nome do arquivo sem a extensão
                            $filename = pathinfo($file, PATHINFO_FILENAME);

                            //criptografando o nome do arquivo, sem permitir repetições nos padrões
                            $filename = md5(uniqid(time()).$filename);

                            //nome do diretório que armazenará os arquivos, já criptografados, inseridos pelo user
                            $dir = "imgs_uploads/";

                            //armazenando o nome temporário do file
                            @$arquivo_tmp = $_FILES['fleFoto']['tmp_name'];
                                
                            //pegando a extensão do arquivo
                            $extfile = strrchr($file, ".");
                                
                            //setando um padrão para armazenagem
                            $img = $dir . $filename . $extfile;
                            
                            //pegando o tamanho do arquivo
                            @$filesize = $_FILES['fleFoto']['size'];

                            //tranforma de bytes para kbytes
                            $filesize = round($filesize / 1024);
?>