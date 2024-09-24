#!/bin/bash
cd GestionEmpr
git pull
git add .
git commit -m "Commit s/auto"
if [ $? -eq 0 ]; then
	echo "___________________________"
        echo "|Commit exitoso en GestEmp|"
	echo "|_________________________|"
    else
	echo "__________________________________________"        
	echo "|Error al hacer commit en GestEmp o vacío|"   
	echo "|________________________________________|"
    fi
git push

cd Empresa
git pull
git add .
git commit -m "Commit s/auto"
if [ $? -eq 0 ]; then
	echo "___________________________"
        echo "|Commit exitoso en GestEmp|"
	echo "|_________________________|"
    else
	echo "__________________________________________"        
	echo "|Error al hacer commit en GestEmp o vacío|"   
	echo "|________________________________________|"
    fi
git push

cd ../AccesoDatos
git pull 
git add .
git commit -m "Commit s/auto"
if [ $? -eq 0 ]; then
	echo "_______________________________"
        echo "|Commit exitoso en AccesoDatos|"
	echo "|_____________________________|"
    else
	echo "______________________________________________"        
	echo "|Error al hacer commit en AccesoDatos o vacío|"   
	echo "|____________________________________________|"
    fi
git push
if [ $? -eq 0 ]; then
	echo "_____________________________"
        echo "|Push exitoso en AccesoDatos|"
	echo "|___________________________|"    
    else
	echo "____________________________________"        
	echo "|Error al hacer push en AccesoDatos|"   
	echo "|__________________________________|"
    fi

cd ../ProgramacionMultimediaYDispositivosMoviles
git pull 
git add .
git commit -m "Commit s/auto"
if [ $? -eq 0 ]; then
	echo "_______________________________"
        echo "|Commit exitoso en Multimedia |"
	echo "|_____________________________|"
    else
	echo "_____________________________________________"        
	echo "|Error al hacer commit en Multimedia o vacío|"   
	echo "|___________________________________________|"
    fi

git push
if [ $? -eq 0 ]; then
	echo "_____________________________"
        echo "|Push exitoso en Multimedia |"
	echo "|___________________________|"    
    else
	echo "____________________________________"        
	echo "|Error al hacer push en Multimedia |"   
	echo "|__________________________________|"
    fi

cd ../ProgramacionProcesosYServicios
git pull 
git add .
git commit -m "Commit s/auto"
if [ $? -eq 0 ]; then
	echo "_______________________________"
        echo "|Commit exitoso en Proc y Serv|"
	echo "|_____________________________|"
    else
	echo "______________________________________________"        
	echo "|Error al hacer commit en Proc y Serv o vacío|"   
	echo "|____________________________________________|"
    fi
git push
if [ $? -eq 0 ]; then
	echo "_____________________________"
        echo "|Push exitoso en Proc y Serv|"
	echo "|___________________________|"    
    else
	echo "____________________________________"        
	echo "|Error al hacer push en Proc y Serv|"   
	echo "|__________________________________|"
    fi

cd ../Interfaces
git pull 
git add .
git commit -m "Commit s/auto"
if [ $? -eq 0 ]; then
	echo "_______________________________"
        echo "|Commit exitoso en Interfaces |"
	echo "|_____________________________|"
    else
	echo "______________________________________________"        
	echo "|Error al hacer commit en Interfaces o  vacío|"   
	echo "|____________________________________________|"
    fi
git push
if [ $? -eq 0 ]; then
	echo "_____________________________"
        echo "|Push exitoso en Interfaces |"
	echo "|___________________________|"    
    else
	echo "____________________________________"        
	echo "|Error al hacer push en Interfaces |"   
	echo "|__________________________________|"
    fi

cd ../Apuntes2
git pull
git add .
git commit -m"Commit s/auto"
if [ $? -eq 0 ]; then
	echo "____________________________"
        echo "|Commit exitoso en Apuntes2|"
	echo "|__________________________|"
    else
	echo "____________________________________________"        
	echo "|Error al hacer commit en Apuntes2 o  vacío|"   
	echo "|__________________________________________|"
    fi
git push
if [ $? -eq 0 ]; then
	echo "__________________________"
        echo "|Push exitoso en Apuntes2|"
	echo "|________________________|"    
    else
	echo "_________________________________"        
	echo "|Error al hacer push en Apuntes2|"   
	echo "|_______________________________|"
    fi
