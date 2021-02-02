<?php 

namespace App\Model;

class FileUpload 
{

    public  $file;
    private $extension = ['jpg', 'png'];
    private $size = 2;
    private $randomName = false; 
    private $uploadDir = './../../upload/';


    public function setFile($value)
    {
        $this->file = $value;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setExtension($value)
    {
        if (is_array($value)) {
     
            $this->extension = $value;
     
        } else {
     
            $this->extension = array($value);

        }
    }

    public function getExtension()
    {
        return $this->extension;
    }

    private function getSize($value)
    {
        return $this->size/1024/1024;
    }

    public function __construct($file = null)
    {
        $this->setFile($file);
    }

    public function upload()
    {

        if($this->getFile()['error']){

            echo $this->checkErrorsFile($this->getFile()['error']);
            exit;

        }

        if ($this->getSize($this->getFile()['size']) >= $this->size) {
            echo "Somente aquivos de até 2MB são permitidos";
            exit;
        }

        $extension = explode('/', $this->getFile()['type']);
        $extensionFile = $extension[1];

        if (!in_array($extensionFile, $this->extension)) {

            echo 'Tipo de arquivo inválido => '.$extensionFile;
            echo '<br>São aceitos apenas aquivos do tipo => '. implode(', ', $this->getExtension());
            exit;
        }

        if (!$this->hasUploadDir($this->uploadDir)) {
            echo "O diretório para o upload não existe";
            exit;
        }

        $fileName = $this->randomName ? date('dmyhis').rand().'.'.$extensionFile : $this->getFile()['name'];

        if(move_uploaded_file($this->getFile()['tmp_name'], $this->uploadDir.'/'.$fileName))
        {
          echo 'Arquivo enviado com sucesso!';
          exit;
        }
        else
        {
          echo 'Ocorreu um erro ao enviar o arquivo '.$fileName;
          exit;
        }

    }
    
    private function checkErrorsFile($exeption)
    {
        switch ($exeption) { 

            case UPLOAD_ERR_INI_SIZE: 
                $message = 'O arquivo enviado excede o tamanho máximo de envio da diretiva upload_max_filesize do php.ini';
            break; 
            
            case UPLOAD_ERR_FORM_SIZE: 
                $message = 'O arquivo enviado excede a directive MAX_FILE_SIZE que foi especificada o formulário HTML';
            break; 
            
            case UPLOAD_ERR_PARTIAL: 
                $message = 'O arquivo enviado foi enviado parcialmente';
            break; 
            
            case UPLOAD_ERR_NO_FILE: 
                $message = 'Nenhum arquivo foi enviado'; 
            break; 
            
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = 'Não é possível encontrar a pasta temporária'; 
            break; 
            
            case UPLOAD_ERR_CANT_WRITE: 
                $message = 'Falha ao escrever o arquivo no disco'; 
            break; 
            
            case UPLOAD_ERR_EXTENSION: 
                $message = 'Uma extensão do PHP interompeu o envio do arquivo';
            break; 
            
            default: 
                $message = 'Erro de envio desconhecido'; 
            break; 
        }
        
        return $message; 
    }

    private function hasUploadDir($dir)
    {
        if (file_exists($dir)) {
            return true;
        }

        return false;
    }



}