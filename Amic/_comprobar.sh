#!/bin/bash

# Obtener la lista de archivos .txt en el directorio actual
files=(*.txt)

# Comprobar si hay archivos
if [[ ${#files[@]} -eq 0 ]]; then
  echo "No hay archivos .txt en el directorio actual."
  exit 1
fi

# Barajar la lista de archivos
shuffled_files=($(for file in "${files[@]}"; do echo "$file"; done | shuf))

# Leer los archivos sin repetir
echo "Mostrando contenido de todos los archivos:"
for file in "${shuffled_files[@]}"; do
  echo "Amigo de $file:"
  cat "$file"
  echo ""
done
