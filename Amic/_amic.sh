#!/bin/bash

# Nombres del grupo
group=("ale3" "juan" "paco" "javi" "angel" "asen" "migo" "charly" "marquez" "gines")

# Crear una copia para los destinatarios
remaining=("${group[@]}")

# Función para eliminar un elemento del array
remove_from_array() {
  local value=$1
  local -n arr=$2
  for i in "${!arr[@]}"; do
    if [[ "${arr[i]}" == "$value" ]]; then
      unset 'arr[i]'
      break
    fi
  done
  arr=("${arr[@]}") # Reindexar
}

# Bucle para asignar a cada miembro un nombre
for giver in "${group[@]}"; do
  # Eliminar el propio nombre de las posibles opciones
  options=("${remaining[@]}")
  remove_from_array "$giver" options

  # Si solo queda un destinatario y es el propio "giver", intercambia con otra persona
  if [[ ${#options[@]} -eq 0 ]]; then
    echo "Error: no se puede completar el intercambio."
    exit 1
  fi

  # Seleccionar aleatoriamente al destinatario
  recipient=${options[RANDOM % ${#options[@]}]}

  # Crear archivo con el nombre del "giver"
  echo "$recipient" > "${giver}.txt"

  # Eliminar el "recipient" del array remaining
  remove_from_array "$recipient" remaining
done

echo "Asignaciones completadas. Archivos generados."
