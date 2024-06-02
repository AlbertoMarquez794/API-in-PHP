import matplotlib.pyplot as plt

# Datos
años = [2000, 2005, 2010, 2015, 2020, 2025]
hombres = [35.9, 31.0, 26.8, 23.2, 20.1, 17.4]
mujeres = [12.9, 10.8, 9.1, 7.5, 6.2, 5.2]

# Crear el gráfico de líneas
plt.figure(figsize=(10, 6))
plt.plot(años, hombres, marker='o', label='Hombres', color='blue')
plt.plot(años, mujeres, marker='o', label='Mujeres', color='red')

# Añadir etiquetas y título
plt.xlabel('Año')
plt.ylabel('Porcentaje de fumadores')
plt.title('Porcentaje de Hombres y Mujeres Fumadores de Tabaco en México (2000-2025)')
plt.legend()
plt.grid(True)

# Mostrar el gráfico
plt.show()
