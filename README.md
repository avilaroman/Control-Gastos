# Integrantes

ESPARZA ZAMARRIPA, JOSE EDUARDO         neoraidenx@gmail.com

SEGUAME REYES, MIGUEL			seguame@gmail.com

# Sitio demo
http://alanturing.cucei.udg.mx/cc409/gastosse/
Administrador: admin/admin
Cliente: test/test

# Control de Gastos de Cuentas en un Despacho

Un despacho fiscal-contable desea llevar el control de los gastos que se realizan durante un proceso y que pueden ser atribuidos a un "contrato", de esto modo, esos montos podrán ser cobrados al cliente.
El flujo del negocio se puede resumir de la siguiente manera:

1. Un cliente crea un contrato con el despacho para que sea atendido un asunto en específico.
1. El despacho genera el expediente del cliente.
1. El despacho genera el expediente del contrato.
1. El despacho lleva a cabo el asunto.
1. El despacho registra los gastos generados por ese asunto.
1. El despacho cobra una comisión por los gastos generados.
1. El despacho le entrega al cliente un estado de cuenta.
1. El cliente paga el contrato o realiza un abono.

## Los clientes y los contratos
El despacho cuenta con varios clientes y cada uno de estos puede tener distintos "contratos" las cuales se entienden como casos que se atienden dentro del despacho.
Los clientes son divididos en persona fisicas y personas morales, y la diferencia entre estas dos radica en son los datos personales, ya que una persona física tiene nombre y apellidos, y una persona moral tiene nombre de empresa.
De todos los clientes se obtiene el RFC, el domicilio (calle, no ext, no int, entre que calles, referencias extras, estado, municipio, colonia y cp), además de uno o varios teléfonos, uno o varios correos y una o varias cuentas bancarias.
Los únicos datos obligatorios de un cliente son los datos personales y el RFC, lo demás puede ser capturados conforme se vayan obteniendo.
Un cliente puede tener uno o varios contratos y no es obligatorio que esten saldados.

Al crear un contrato se almacena la fecha del contrato, el asunto o asuntos que se llevarán a cabo, el período fiscal al que pertenece, el presupuesto (el cuál es el monto que se cobrará por ese contrato) y en caso de que el contrato se pague en plazos, se indica la cantidad de plazos.
Se puede crear un contrato sin presupuesto siempre y cuando se muestre una alerta indicando que no se recomienda dejar el presupuesto en blanco.

Los asuntos son las activades con las que esta relacionada un contrato, es decir, el caso que deberá llevar a cabo el despacho.
Existen reglas referentes a los asuntos a tratar, y deben mantenerse una relación de los asuntos con sus reglas. Aquí un ejemplo de reglas:
* Algunos asuntos obligan a que gastos internos del despacho sean cargados a el contrato
* Algunos asuntos no tienen un presupuesto, pues el cobro es una tarifa mensual

Cada contrato tiene una persona contacto, que es la persona encargada de hacer el cobro y sobre todo, es la persona que ha traído al despacho a este cliente. De esta persona de contacto se debe almacenar  los datos personales y uno o varios telefonos, uno o varios correos y una o varias cuentas bancarias.
Además de la persona de contacto, en el proceso de un contrato participan terceros a los que se les llamará participaciones institucionales y de los cuales se tienen los mismos datos que de los contactos.

## Cuentas sin presupuesto
Para las cuentas sin prespuesto, se mencionó que lo que se cobra es una tarifa fija mensualmente.
Estas cuentas requiere que se genera una tabla de pagos con la fecha del pago y el monto, esta tabla se generá a partir del mes siguiente a la fecha del contrato y será por la cantidad de meses indicada por el usuario bajo el campo de "Renovación".
Al concluir el tiempo de renovación, deberá aparecer una alerta en el sistema para indicar si se desea renovar y entonces generar los siguientes "n" meses indicados por el usuario.

## Los gastos y los abonos
Los gastos son absorbidos por el despacho en primera instancia, pero deben ser registrados en el sistema, para que puedan ser cobrados al cliente mas adelante.
Al registrar un gasto se debe conocer a que categoría pertenece el gasto, comentarios al respecto, el costo (lo que pago el despacho por ese gasto), el precio (la cantidad en que será cobrada al cliente ya con la comisión) y el modo de pago (efectivo, en especie, cheque, depósito, transferencia).
Para todos los tipos de pago se desea saber quien hizo el pago y quien lo recibió. En caso de cheques, transferencias y depositos se debe poder elegir las cuentas bancarias de origen y destino.

Los abonos son pagos realizados por el cliente, y estos pueden ser abonados a una cuenta, o en caso de ser una cuenta por plazos, deben ser aplicados a una de las igualas, o varias de las igualas en caso de que la cantidad de dinero lo permita.
La información almacenada referente a los abonos es la misma que en los gastos, a excepción de la categoría pues esta ya no es requerida. Se pide también poder indicar si este abono representó una factura y que número de factura se utiliza.

## Los reportes

Se desea poder consultar la información de las siguientes maneras:

1. Estado de contrato del cliente (con costo o con precio)
1. Estado de cuenta de igualas
1. Contratos pendientes por cobrar
1. Contratos con igualas vencidas
1. Contratos por cobrar agrupadas por contacto
1. Transacciones de las cuentas bancarias internas

Los reportes deben poder ser descargados a una hoja de calculo, generar un PDF, o poder ser enviadas por correo desde la aplicación a terceros.

Por medio de un calendario se deben mostrar las fechas de vencimiento de igualas, de esta manera será mas fácil llevar el control de pagos.

## Los niveles de usuarios

Se deben poder generar perfiles de usuarios.
Los perfiles facilitan la labor al momento de generar accesos a los usuarios.

Para los perfiles se recomienda que sean generados en base a una configuración seleccionada por el administrador, por ejemplo, al crear un perfil se muestran distintas tareas que pueden ser realizadas y estas son seleccionadas para poder dar los permisos.

* Captura de clientes
* Captura de Cuentas bancarias
* Captura de precio modificado
* Captura de Contratos
* Captura de Gastos
* Captura de Abonos
* Acceso a reportes
Y de la misma manera agregar las reglas para edición y eliminación.

Ya teniendo los perfiles creados se puede entonces agregar usuarios a los perfiles para que estos puedan acceder al sistema.
