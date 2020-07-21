-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-07-2020 a las 18:45:04
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mac_dtec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fincas`
--

DROP TABLE IF EXISTS `fincas`;
CREATE TABLE IF NOT EXISTS `fincas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fincas`
--

INSERT INTO `fincas` (`id`, `nombre`, `codigo`) VALUES
(1, 'Ricardo Gómez', 'RG'),
(2, 'Francisco González', 'FG'),
(3, 'Marquesa Montenergro', 'MM'),
(4, 'Colonia Jaime', 'CJ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hitos`
--

DROP TABLE IF EXISTS `hitos`;
CREATE TABLE IF NOT EXISTS `hitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` text NOT NULL,
  `indicador` text NOT NULL,
  `unidad_medida` varchar(100) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `esperado` int(11) NOT NULL,
  `alcanzado` int(11) NOT NULL,
  `medios_verificacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hitos`
--

INSERT INTO `hitos` (`id`, `producto`, `indicador`, `unidad_medida`, `anio`, `esperado`, `alcanzado`, `medios_verificacion`, `fecha`, `usuario_id`) VALUES
(1, '1- Plan de trabajo', 'Plan de trabajo presentado y aprobado por instancia pertinente.', 'Cantidad', '2015', 1, 0, 'Copia del informe y del dictamen que aprueba el informe.', '2015-08-20 00:00:00', 4),
(2, '2- Diagnostico y características de sistemas productivos/análisis incluyendo la determinación de la sustentabilidad a través de los puntos críticos de los sistemas productivos.', 'informe presentado ante subsecretaria de Agricultura familiar y el Ministerio de la Producción de Santiago del Estero.', 'Cantidad', '2015', 1, 0, 'Copia archivada del informe y copia de remito de envio a SSAF archivada en oficina del proyecto', '2015-08-20 00:00:00', 4),
(3, '3.- Construcción de una metodología para seguimiento, identificación criterios de evaluación del proyecto e identificación experiencias de comercialización alternativas', 'Protocolo Metodológico y base de datos sobre el tema de la comercialización y economía social y solidaria\r\n', 'Cantidad', '2015', 1, 0, 'Protocolo aprobado por la Dirección del Proyecto. Base de datos disponible para su verificación en sede del proyecto ', '2015-08-20 00:00:00', 4),
(4, 'Organización de espacio para discusión de Metodologías de Articulación entre las Universidades y el medio ', 'Primera Jornada Dtec desde la UNSE al medio- Julio 2017', 'Cantidad ', '2017', 1, 0, 'Listado de asistentes, registro gráfico (fotografías), informe de la jornada, conclusiones ', '2017-03-17 00:00:00', 6),
(5, '5- Biblioteca virtual sobre la temática agricultura Base bibliográfica sobre agricultura familiar', 'Base bibliografica sobre agricultura familiar', 'cantidad', '2017', 1, 0, 'Biblioteca virtual en funcionamiento y disponible para el equipo y todos los que soliciten.', '2017-03-20 00:00:00', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores`
--

DROP TABLE IF EXISTS `indicadores`;
CREATE TABLE IF NOT EXISTS `indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `indicadores`
--

INSERT INTO `indicadores` (`id`, `nombre`, `codigo`, `categoria_id`) VALUES
(1, 'Articulación con instituciones públicas', 'AIP', 1),
(2, 'Satisfacción de las Necesidades Básicas', 'SNB', 1),
(3, 'Aceptabilidad del Sistema de Producción', 'ASP', 1),
(4, 'Generación de Empleo', 'GE', 1),
(5, 'Diversificación de productos', 'DP', 1),
(6, 'Superficie de Producción de Autoconsumo', 'SPA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores_categorias`
--

DROP TABLE IF EXISTS `indicadores_categorias`;
CREATE TABLE IF NOT EXISTS `indicadores_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `indicadores_categorias`
--

INSERT INTO `indicadores_categorias` (`id`, `nombre`, `codigo`) VALUES
(1, 'Dimensión Socio Cultural', 'ISC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_avances`
--

DROP TABLE IF EXISTS `informes_avances`;
CREATE TABLE IF NOT EXISTS `informes_avances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anio` varchar(4) NOT NULL,
  `codigo_proyecto` int(11) NOT NULL,
  `universidad` varchar(100) NOT NULL,
  `proyecto` varchar(100) NOT NULL,
  `componente` int(11) NOT NULL,
  `director_proyecto_id` int(11) NOT NULL,
  `periodo_informe` datetime NOT NULL,
  `fecha_ita` datetime NOT NULL,
  `resultados_pa` text NOT NULL,
  `grado_avance` text NOT NULL,
  `analisis_causal` text NOT NULL,
  `ajustes` text NOT NULL,
  `sintesis` text NOT NULL,
  `avance_transferencia` text NOT NULL,
  `presupuesto_estado` text NOT NULL,
  `acciones_gastos` text NOT NULL,
  `comentarios` text NOT NULL,
  `anexos` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `director_proyecto_id` (`director_proyecto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes_avances`
--

INSERT INTO `informes_avances` (`id`, `anio`, `codigo_proyecto`, `universidad`, `proyecto`, `componente`, `director_proyecto_id`, `periodo_informe`, `fecha_ita`, `resultados_pa`, `grado_avance`, `analisis_causal`, `ajustes`, `sintesis`, `avance_transferencia`, `presupuesto_estado`, `acciones_gastos`, `comentarios`, `anexos`, `created_at`, `updated_at`) VALUES
(1, '2017', 1613, 'Universidad Nacional de Santiago del Estero', 'Diseño de procesos alternativos de transferencia tecnológico/productivas hacia sistemas de producció', 5, 6, '2016-09-01 00:00:00', '2017-08-31 00:00:00', '4.- Organización de espacio para discusión de Metodologias de Articulación entre las Universidades y el medio: Organización y disertación junto a componentes 2 y 3 de II Jornadas Agroecológicas del Dtec, con 34 asistentes, 11/07/2017. Charla en el Colegio David Mc Taggart. Tema: “¿sólo gas o electricidad? Energías renovables” Capacitadores: Ings. Franco Raúl Fernández y Julia Teresita Vidal. Fecha 7 de junio de 2017, con 100 estudiantes de nivel primario. 5- Biblioteca virtual sobre la tematica agricultura familiar: se actualizó la base de bibliografía en la temática de energías renovables. 6.- Capacitaciones para productores: (Anexo ITA 2 C5) Taller en la Escuela Técnica N 10 “María Santísima” y productores, en el tema “Energías Renovables”, Ruta 1, Villa Robles, Dpto. Robles. 14 de octubre de 2016, con la participación de 52 asistentes- Taller en el Colegio Ciudad del Barco, en el tema “Energías Renovables”, El Polear, Dpto. Banda. 20 de octubre de 2016, con 40 asistentes. Charla para devolución de resultados a productores sobre el tema: \"La Huella de Carbono en las actividades productivas de Colonia Jaime\", 11/07/2017. 7-Guías para productores: se elaboró una guía para el acondicionamiento del criadero de pollos a cargo del PAF 9, y guía para la confección de un termotanque solar de alto rendimiento y destilador solar a cargo del PAF 10 (Anexo ITA 2 C5); folleto de divulgación elaborado y entregado (Anexo ITA 2 C5). Hitos 8 al 13: no aplican a esta componente. 14.- Modelo energético del sistema agricultor familiar diseñado: se realizaron las siguientes propuestas de incorporación de energías renovables en las fincas de productores: Destilador solar demostrativo y Termotanque solar en finca de flia González- Destilador Solar y Secadero solar de frutos nativos en flia Marquesa Montenegro - Sistema de Calefacción - iluminación en criadero de pollos en finca flia Gómez (anexo ITA 2 C5). 15.- Sistema de Energía Renovable instalado y funcionando: destilador demostrativo instalado en finca flia González; termotanque solar, destilador y secadero solar en etapa de construcción, serán concretados en el primer semestre del año 3 (anexo ITA 2 C5). 16.- Cambio de escala desde los productores del proyecto a asociaciones de los productores de la agricultura familiar e instituciones educativas agrícolas: se firmó el acta acuerdo con Escuela Técnica N°10 María Santísima, dpto Robles, con orientación agrotécnica (Anexo ITA 2 C5). Se firmó un Acta Acuerdo de cooperación científica y tranferencia entre el Grupo de Investigación del proyecto APROVECHAMIENTO DE ENERGÍA SOLAR, UTILIZANDO TECNOLOGÍA TIPO WICKLESS LOOP HEAT PIPE, PARA CALENTAMIENTO DE AIRE, ORIENTADO AL SECADO DE ALIMENTOS- FAyA y D-TEC-UNSE.', 'Durante el segundo año de trabajo, se pudieron concretar las siguientes actividades propuestas en el cronograma: 5.1.ajustar los diseños propuestos con pruebas de campo: se pudo realizar en los viajes periodicos a cada productor, toma de muestras y análisis realizados con la colaboración de diferentes laboratorios e instituciones (anexo ITA II C5); 5.2.se realizaron talleres de divulgación general: en el período informado se realizaron 4 talleres, además se concretó la publicación en el ámbito académico de los resultados obtenidos, con tres publicaciones en congresos; 5.3. Instalación y puesta en marcha del sistema diseñado: esta etapa se pudo concretar sólo a modo experimental con el desilador demostrativo; el resto de las propuestas están en la etapa de compra de materiales y contrucción.5.4. Apoyo en la implementación del sistema: se concretó un acuerdo de cooperación con especialistas en implementación de secaderos solares de la FAyA y FCEyT de la UNSE; si inició una consulta técnica sobre uso de biomasa en calefacción con técnicos del INTI- Tucumán; se cuenta con la colaboración del Lab. de Biomasa de FCF-UNSE; 5. 5. Capacitar en el manejo del sistema a un productor: aunque aún no se concluyó con la puesta en marcha de los sistemas/artefactos propuestos, en el diseño de los mismos se interactuó con los productores sobre cómo sería su manejo, aspectos a tener en cuenta sobre su cuidado, requerimientos y el principio básico de funcionamiento; 5.6. Realizar visitas una vez puesto en funcionamiento: se realizaron visitas en la finca dónde se instaló el destilador demostrativo para los ajustes necesarios, en el resto de los productores se está en etapa de evaluar dónde serán emplazados los módulos de destiladores, el secadero, y nuevo criadero de pollos; 5.7. Capacitación específica de un PAF: en relación a la formación de los PAF, los mismos se entrenaron en la escritura de las guías elaboradas con un lenguaje adaptado a todo público, en la redacción de resúmenes para congresos, en la realización de presentaciones orales para diferentes públicos universitarios, escolares y productores. Además se firmó una Acta Acuerdo para la realización de una pasantía por ocho meses para el PAF 9, Ing. Vidal, en el Equipo de investigación sobre energía solar a cargo del profesor Lic. M.Sc. Carlos Alberto Cattaneo (FAyA, FCEyT de la UNSE), para el desarrollo de un propotipo de secadero solar de frutos nativos.', 'Actualmente se esta en la etapa compra de materiales, construcción y busqueda de apoyo/colaboración de otras instituciones para la ejecución del termotanque solar y el secadero de frutos, con un grado de avance del 60%, los demás diseños propuestos, destiladores y criadero, su ejecución tiene un grado de avance de aproximadamente de 10%. Los desvíos temporales se deben a demoras en la ejecución de la compra de materiales por razones ajenas al componente 5.', 'Las medidas corretivas y ajustes que se realizarán será la busqueda de apoyo y colaboración de otras instituciones, y la busqueda de medios alternativos para la obtención de los materiales necesarios para la ejecución de los diseños propuestos.', 'En el caso del productor del área de secano (Sra. Marqueza), se diseñó un destilador solar compuesto en módulos, el mismo aún no se ejecutó. Se incorporó la propuesta de secadero solar de frutos nativos, la cual está en marcha. En el primer tipo de productor familiar de la zona de riego (Sr. Ricardo), se diseñó un criadero de pollos con criterios de construcción bioclimáticos, con la incorporación de un sistema de iluminación por paneles fotovoltaicos, y un sistema de calefacción a base de energía de biomasa. El principal avance, a pesar de que el diseño no se pudo ejecutar, es que el productor en base a la propuesta realizada, se involucró en el proyecto e incorporó las recomendaciones realizadas por el equipo para mejorar la construcción del criadero y de esta manera construyó por cuenta propia un nuevo criadero, y así pudo duplicar la producción de pollos. En el segundo tipo de productor familiar de la zona de riego (Sr. Francisco), se diseñó e instaló un destilador solar con fines educativos/didácticos. Se diseñó un termotanque solar, el cual está en etapa de construcción.', 'En relación a los avances en articulaciones con otras instituciones, se firmó un acta acuerdo de cooperación científica, técnica y transferencia con la Escuela Técnica N10, Dpto Robles; y con el Equipo de investigación en energía solar de la FAyA-UNSE. Se está trabajando en el asesoramiento para el Diseño de un sistema web para la gestión de proyectos universitarios interdisciplinarios- caso de estudio Componente 5, Trabajo fin de graduación en Lic en Sistemas de Información de la FCEyT-UNSE. En el mes de septiembre 2017, se firmará un acta acuerdo con el Lab de Biomasa ITM-FCF- UNSE para la realización de una práctica profesional supervisada para la formación de un estudiante de la facultad de ciencias forestales (FCF) en la construcción de un prototipo de estufa a base de biomasa adaptada a las necesidades del criadero de pollos. ', 'Se realizaron los procedimientos respectivos a la compra de bienes y equipamiento, la cual recibió la no objeción y está en etapa de compra de los bienes', 'Se está trabajando en equipo para gestionar las compras de materiales e insumos de laboratorio y ferretería', 'Además de las actividades mencionadas, se participó en el \"Tercer Congreso del Foro de Universidades Nacionales para la Agricultura Familiar\", entre el 27 y 28 de octubre del 2016, en la ciudad de Corrientes, con la presentación de dos trabajos: \"ANÁLISIS MULTIDISCIPLINARIO DE SISTEMAS DE PRODUCCIÓN DE LA AGRICULTURA FAMILIAR: EXPERIENCIA DEL PROYECTO DOCTORES EN UNIVERSIDADES PARA TRANSFERENCIA TECNOLÓGICA – UNIVERSIDAD NACIONAL DE SANTIAGO DEL ESTERO\"- Figueroa et al.; \"EVALUACIÓN DE LA SUSTENTABILIDAD DE TRES SISTEMAS DE PRODUCCIÓN FAMILIAR DE LA PROVINCIA DE SANTIAGO DEL ESTERO MEDIANTE USO DE INDICADORES\"-Vásquez Yoshitake et al. Se enviaron trabajos a los siguientes congresos (aceptados): II Congreso Internacional Gran Chaco Americano-5 y 6/10/2017- \"Relevamiento energético en un sistema productivo comunitario, Santiago del Estero, Argentina\" - María Eugenia Figueroa, Franco R. Fernández, Julia Teresita Vidal; Encuentro Jóvenes Investigadores 11 al 13/10/2017 \"Caracterización de requerimientos energéticos en sistemas productivos familiares rurales: un aporte para el desarrollo sustentable\"- Teresita Vidal, María Eugenia Figueroa, Franco Fernández; \"Caracterización de sistemas de producción de la agricultura familiar: una experiencia del proyecto DTEC/UNSE para el diseño de mecanismos de transferencia técnico/productiva\"- Figueroa et al. El C5 participó en un seminario interno por medio del PAF 9, el cual disertó la temática: “Energías renovables en el mercado eléctrico” el día 7 de abril del 2017 (anexo ITA 2- C5). Los PAF del componente 5 dictaron una charla el 7/6/2017, en el Colegio David Mc Taggart. Tema: “¿Sólo gas o electricidad? Energías renovables” en el marco del Día Mundial del Medioambiente. El PAF 9, participa del programa \"Los Científicos van a las escuelas\" asesorando a docentes de la provincia en temáticas relacionadas a las energías renovables. Se organizaron junto con las componentes 2 y 3 las II jornadas agroecológicas en la comunidad de Colonia Jaime, 11 julio 2017. El laboratotio de Biomasa de la FCF-UNSE, colaboró con el C5 en el procesado de muestras de leña y marlos utilizados como combustibles por los productores (determinación de poder calorífico, cenizas, volátiles) El Ministerio del Agua de la provincia de Sgo del Estero, por medio del Lab. de control de calidad, realizó el análisis físico- químico del agua de pozo de la flia Montenegro (anexto ITA 2 C5). El Departamento Académico de Química - FCEyT- UNSE, por medio del Ing. Antonio Ramírez, colaboró en viaje de campo del C5, a la flia Montenegro para evaluar viabilidad de la perforación de agua, el 22/03/2017 (anexo ITA 2 C5). El C5 trabaja en el asesoramiento del trabajo final de graduación de alumnos de la Lic en Informática de FCEyT- UNSE, en el tema \"aplicación de un sistema WEB en la gestion de proyectos interdisciplinarios\", dirigido por la Lic. Saritha Figueroa. Mas información se detalla en Anexo ITA II C5.', '', NULL, NULL),
(2, '2018', 1613, 'UNIVERSIDAD NACIONAL DE SANTIAGO DEL ESTERO', 'Diseño de procesos alternativos de transferencia tecnológico/productivas hacia sistemas de producció', 5, 6, '2018-06-13 00:00:00', '2018-06-13 00:00:00', 'Las metas del componente 5 propuestas en el plan de trabajo inicial (Anexo I) fueron cumplidas en un 80 %. Los principales productos previstos fueron: 1. Diagnóstico (hito 1, 2 y 3), esta etapa fue fundamental para diseñar las acciones a seguir, significó un 25 % del total de actividades, este producto se cumplió en un 100 %. 2. Diseño (hito 14), el diseño de propuestas significó un 15 % del total de actividades y se cumplió en un 100 %. 3. Puesta en práctica del diseño (hito 15) esta etapa central del componente significó un 50 % de las actividades, las principales dificultades del componente 5 estuvieron en ejecutar este producto, el cual se completó en un 30% hasta la fecha de elaboración de este informe. 4. Divulgación (hito 4, 5, 6, 7 y 16), estas actividades significaron un 10 % del total y fueron completadas satisfactoriamente en un 100%. A continuación se detallan las metas anuales del Sistema de Monitoreo del Proyecto (Anexo I): Hito 1. Presentación del Plan de Trabajo (Anexo I): se diseñó en el mes de noviembre de 2015 a partir de la designación del componente 5, mediante visita y entrevistas a los cuatro productores del proyecto. Hito 2. Diagnóstico y caracterización de sistemas productivos/análisis incluyendo la determinación de la sustentabilidad a través de los puntos críticos de los sistemas productivos (Anexo II). Se realizó el relevamiento energético, análisis de la huella de carbono en el uso de la energía y se confeccionaron cuatro indicadores de sustentabilidad energética, los cuales fueron estimados al comienzo del proyecto sin la intervención del mismo y serán medidos nuevamente al finalizar el proyecto durante el último mes, a fin de realizar una comparación de los efectos de las intervenciones. Estos análisis forman parte de diferentes comunicaciones a congresos. Esta etapa demandó 6 meses de trabajo y fue muy importante para conocer cada sistema productivo y sus necesidades. El principal desafío para el componente fue comunicar los resultados del diagnóstico energético a cada productor y lograr que el mismo visualice y reconozca su propio sistema productivo desde el punto de vista del flujo de la energía y las diferentes interacciones que se generan a partir de ella. Hito 3. Construcción de una metodología para seguimiento, identificación criterios de evaluación del proyecto e identificación experiencias de comercialización alternativas. Este hito no aplica a la componente 5, sin embargo se colaboró con las entrevistas como insumo para las actividades de la componente 1. Hito 4. Organización de espacio para discusión de metodologías de articulación entre las universidades y el medio (Anexo Hito 4 del informe técnico general). Se lograron organizar diferentes espacios de participación y acercamiento entre el proyecto DTEC UNSE, estudiantes y docentes universitarios y de escuelas primarias, secundarias, productores y asociaciones de productores en los cuales la componente 5 contribuyó en la sensibilización sobre el uso de las energías renovables y en dar a conocer las experiencias de trabajo entre la universidad y los productores; como así también se logró que los productores participaran activamente junto al equipo del proyecto impartiendo charlas conjuntamente. Hito 5. Biblioteca virtual sobre la temática agricultura familiar. Se actualizó la base de bibliografía en la temática de energías renovables. Hito 6. Capacitaciones para productores (Anexo III y Anexo Hito 6 del informe técnico general). Se realizaron satisfactoriamente las capacitaciones planificadas. A principios del mes de agosto 2018 se prevé la realización de una charla adicional en la granja educativa de uno de los productores una vez instalado el termotanque solar que se encuentra en desarrollo. Hito 7. Guías para productores (Anexo II y Anexo Hito 7 del informe técnico general): se elaboró una guía para el acondicionamiento del criadero de pollos a cargo del PAF 9, y guía para la confección de un termotanque solar de alto rendimiento y destilador solar a cargo del PAF 10; se elaboraron y entregaron folletos sobre huella de carbono en la comunidad de Colonia Jaime; se está elaborando una guía sobre secado y almacenamiento de frutos forrajeros nativos junto al productor de la localidad de Santa Isabel (Dpto. Atamisqui) a partir de un ensayo (en curso) junto a la componente 3 sobre plantas repelentes y almacenamiento de frutos nativos. Se está elaborando una guía sobre el uso de la estufa a biomasa instalada en el productor de la localidad Los Pereyra en el criadero de pollos. Se está en proceso de escritura de un capítulo del libro del proyecto DTEC UNSE. Hitos 8 al 13: Puesta en marcha de un proyecto de comercialización alternativo e innovaciones productivas con valor agregado: no aplican a la componente 5. Hito 14. Modelo energético del sistema agricultor familiar diseñado (Anexo II y Anexo Hitos 14 y 15 del informe técnico general): se diseñaron cinco propuestas de incorporación de energías renovables en base al diagnóstico realizado y a las capacidades del equipo y de los productores: Destilador solar demostrativo y Termotanque solar en finca de flia González- Destilador Solar y Secadero solar de frutos nativos en flia Marquesa Montenegro - Sistema de Calefacción - iluminación en criadero de pollos en finca flia Gómez. Hito 15. Sistema de energía renovable instalado y funcionando: el grado de avance a la fecha es de un 55 % (Anexo Hitos 14 y 15 del informe técnico general). Las principales causas del retraso fueron la dificultad para ejecutar el presupuesto general aprobado, la falta de disponibilidad de recursos económicos para viajes (combustible y viáticos) de campaña en los productores durante los últimos semestres del proyecto, la no ejecución de las compras aprobadas de materiales e insumos correspondientes a los ID FONPRHI 56 y 57, planificadas para los semestres 2 y 3 por la componente 5, la dificultad y demora administrativa en la concreción del CONCURSO DE PRECIOS No 05/2017 denominado “adquisición de BIENES PARA APLICACIONES DE ENERGÍA SOLAR”, correspondiente a los ID FONPRHI 58 y 59 (la cual satisfactoriamente finalizó y se recibieron los equipos en la UNSE recientemente entre el 7 y 13/6/18), como así también la falta de insumos en los mercados locales y de mano de obra local especializada. Estas dificultades afectaron seriamente la concreción de las propuestas diseñadas y significó un retraso en el principal resultado previsto en la componente 5 para esta etapa: lograr interactuar con el productor desde la puesta en práctica de los diseños y propuestas realizadas a partir de diagnóstico. Esta actividad fue clave en la transferencia ya que más allá de instalar el “prototipo diseñado” el objetivo fue experimentar con el productor, que el mismo pueda apropiarse de la tecnología, modificarla, adaptarla, capacitarse en su manejo, todo lo cual supone un proceso no lineal, sino de retroalimentación. No obstante, las experiencias de trabajo adquiridas hasta la fecha con las propuestas que se pudieron concretar, gracias a la colaboración de la UNSE y de los productores, fueron muy significativas y enriquecedoras tanto para la componente como para los productores. El productor se involucró y participó activamente en los ensayos de campo, en la planificación de la toma de datos de factores ambientales, como temperatura y humedad, en la interpretación de resultados y análisis de posibles causas de variación de dichos factores. Actualmente se continúa con los ensayos, mediciones y puesta a punto de la estufa a biomasa, del secadero de frutos y del termotanque solar. Hito 16. Cambio de escala desde los productores del proyecto a asociaciones de los productores de la agricultura familiar e instituciones educativas agrícolas (Anexo III): se llevaron a cabo todas las actividades planificadas en el acta acuerdo con la Escuela Agro técnica N°10 del dpto Robles; se ejecutó satisfactoriamente el plan de trabajo de la pasantía del Paf 9 y se continúa en la etapa de medición del prototipo junto al grupo de trabajo del profesor Carlos Cattaneo en el proyecto Aprovechamiento de energía solar, utilizando tecnología tipo wickless loop heat pipe de la Facultad de Agronomía y Agroindustrias de la UNSE. La concreción del proyecto Universidad y Agricultura Familiar en el marco del acta acuerdo firmado entre INDES UNSE, FAyA UNSE, Secretaría de Agricultura Familiar Sgo del Estero, Federación de Agricultura Familiar Sgo. del Estero Tukuy kuska y el proyecto DTEC UNSE, permitió realizar encuentros entre los productores y la comunidad académica en los cuales los productores del DTEC fueron protagonistas y disertantes de las experiencias de trabajo con el equipo DTEC UNSE. El Componente 5 y el 4 colaboraron en la organización y preparación de la disertación del tema Ser Agricultor Familiar en el Secano en el 3° Módulo del Curso de Dirigentes (Anexo Hito 4 y 16 del Informe General).', 'Otros resultados no planificados originalmente dentro de las actividades de la componente fueron: 1. la concreción del ensayo con plantas repelentes y frutos nativos destinados a forraje, empleando el secadero construido para el almacenamiento de los frutos. El inicio de esta experiencia permitió interactuar activamente con el productor, intercambiar conocimientos y aprendizajes, el ensayo se encuentra en proceso de ejecución. 2. La incorporación de los becarios en equipos de investigación a partir de las actas acuerdos firmadas entre el DTEC UNSE y los proyectos de Ciencia y Técnica de la UNSE como el proyecto “Estudio mediante imágenes digitales del encogimiento de productos alimenticios deshidratados usando secadores solares en Santiago del Estero (COD 23/A237)” bajo la dirección de la profesora Edda Larcher, Facultad de Agronomía y Agroindustrias (FAyA) de la Universidad Nacional de Santiago del Estero, por medio del cual se dio continuidad a las actividades iniciadas durante la pasantía del Paf 9 desde el 1/01/2018 a la fecha. 3. La práctica profesional supervisada (PPS) denominada “Diseño y construcción de un prototipo de estufa a biomasa destinada a un criadero de pollos de pequeña escala de un agricultor familiar” por una parte permitió capacitar al estudiante que realizó la práctica y resolver un proyecto/problema concreto de la vida cotidiana del pequeño productor, y producir tres comunicaciones a congresos; y por otro lado permitió dar inicio a una nueva línea de investigación en la temática de Bioenergía y Dendroenergía, dentro de equipos de investigación ya formados, con la incorporación del doctor de la componente 5 y de la docente guía de la PPS, Ing Myriam Ludueña en el proyecto “Evaluación de la calidad de madera para usos sólidos en especies con aptitud maderera de la Región Chaqueña Seca” CyT FCF UNSE, bajo la dirección de la Dra. Juan Moglia. 4. El desarrollo del Trabajo Final de Graduación denominado “Sistema de información Web para la gestión de proyectos interdisciplinarios D-TEC UNSE” en proceso de redacción realizado por las estudiantes de la carrera Lic. en Sistemas de Información de la FCEyT UNSE: Claudia Herrera y Gladys Fortea, en el marco del proyecto D-TEC UNSE (0016/13). Resol FCEyT N° 0043/2018, permitirá contar con un sistema web modelo que servirá para futuros proyectos interdisciplinarios que atiendan problemáticas de transferencia desde las universidades en sistemas socio- ambientales complejos como los sistemas de producción de la agricultura familiar (Anexo IV).', 'Año 1 Durante el primer año de trabajo, se siguieron satisfactoriamente las etapas propuestas en el cronograma. La evaluación del modo de uso de la energía, convencional y renovable, en cada sistema productivo, se realizó en base a la revisión bibliográfica y de antecedentes para diseñar una metodología de relevamiento de información, todo lo cual se ajustó en terreno y se adaptó a partir de las entrevistas y visitas a la finca de cada agricultor familiar. La caracterización del sistema de vida de cada agricultor familiar permitió comprender la percepción del productor respecto al uso de energías convencionales y renovables. La metodología de evaluación de la huella de carbono y el cálculo de los Indicadores de sustentabilidad energética, de cada agricultor familiar, permitió detectar puntos críticos en el uso de las diferentes fuentes de energía, lo cual fue tomado como criterio para formular estrategias intervención en cada caso. La realización de talleres y las sucesivas entrevistas con los productores permitió una mayor interacción del equipo de trabajo con los mismos y una mejor comprensión de las dificultades y potencialidades de implementar sistemas de aprovechamiento de energías renovables en cada caso. Esta primera etapa posibilitó el diseño de alternativas, aplicadas a las principales actividades productivas de la finca, basadas en las necesidades y percepciones del productor y en el uso eficiente de energía de biomasa y solar. Año 2 y 3 Durante el segundo año de trabajo, se pudieron ajustar los diseños con pruebas de campo, se pudo realizar en los viajes periódicos a cada productor, toma de muestras y análisis realizados con la colaboración de diferentes laboratorios de la UNSE e instituciones del estado provincial. Se realizaron talleres de divulgación general, además se concretó la publicación en el ámbito académico de los resultados obtenidos con publicaciones en congresos y actualmente se está en proceso de edición del libro del proyecto DTEC UNSE en el cual se participa desde la componente 5 con el capítulo denominado “Fuentes renovables de energía en sistemas productivos familiares“. La instalación y puesta en marcha de los diseños se pudo concretar en parte (50%) gracias a la colaboración mediante acuerdos de cooperación con especialistas en implementación de secaderos solares de la FAyA y Facultad de Ciencias Exactas y Tecnológicas (FCEyT) UNSE, Lic Carlos Cattaneo, y del Laboratorio de energía de biomasa de la Facultad de Ciencias Forestales UNSE, Ing Myriam Ludueña. Los desvíos temporales en esta etapa se debieron a la falta de materiales e insumos y a las demoras administrativas en la ejecución del presupuesto, por lo cual se reajustaron los diseños según los materiales disponibles cuando esto fue posible. En relación a la formación de los PAF, los mismos se entrenaron en escritura de comunicaciones a congresos y en la realización de presentaciones orales para diferentes públicos universitarios, escolares y productores. Se concretó una pasantía para el Paf 9 en secaderos solares a cargo del profesor Lic. M.Sc. Carlos Alberto Cattaneo (FAyA, FCEyT UNSE),en tanto que el Paf 10 se encuentra en etapa de ejecución de la tesis de Maestría en Energías Renovables de la UNSa. ', '', '*Destilador solar demostrativo y Termotanque solar en finca de flia González (Anexo II): se instaló el destilador demostrativo, actualmente se están ajustando algunos detalles de la construcción. El termotanque solar se encuentra en etapa de armado de las partes y próximamente será instalado en la finca del productor. Posteriormente se procederá a su medición y evaluación del rendimiento. Está previsto realizar una charla didáctica una vez instalado el sistema en la granja ecológica del productor para interactuar con los estudiantes y difundir las aplicaciones de la energía solar térmica. El retraso en la construcción del mismo se debió a la falta de insumos en los mercados locales y de mano de obra especializada, por lo cual se optó por modificar y reajustar el diseño a los materiales disponibles, y solicitar la colaboración del personal técnico del laboratorio de física de la FCEyT UNSE. \r\n*Destilador Solar y Secadero solar de frutos nativos en flia Marquesa Montenegro (Anexo II): el sistema modular de destiladores solares no podrá ser construido, dado el requerimiento de materiales e insumos que no podrán ser adquiridos, no obstante se prevén futuros proyectos por los cuales canalizar recursos y ejecutar el diseño modular de los destiladores solares. En relación al secadero de frutos nativos se construyó el mismo durante los meses de noviembre y diciembredel 2017. Se realizaron pruebas de su funcionamiento. Resta realizar el plan de mediciones de temperatura y humedad durante los meses cálidos del año y controlar su rendimiento, lo cual será realizado en el marco del proyecto Aprovechamiento de energía solar, utilizando tecnología tipo wickless loop heat pipe de la FAyA UNSE, una vez finalizado el DTEC UNSE. Durante el mes de febrero del 2018 se realizó la recolección de frutos de algarrobo negro (Prosopis alba) en el monte nativo del paraje Santa Isabel junto a integrantes de la flia Montenegro, se recolectaron dos bolsas de 25 kg de algarrobas con destino forrajero. En total se almacenaron 250 kg de frutos en el secadero. Durante el mes de marzo y abril se inició un ensayo en campo y laboratorio junto a la componente 3, para evaluar el efecto de diferentes plantas repelentes (atamisqui, ancoche y jarilla) de insectos en el almacenamiento de los frutos. Para ello se gestionó la donación de cinco tambores de miel en desuso de 200 litros de capacidad en la Cooperativa Coopsol Ltda., con la finalidad de colocar allí los frutos, junto a las plantas repelentes. Este ensayo fue replicado a escala en laboratorio, mientras que en campo el productor participó activamente en las mediciones de humedad de los frutos (con xilohigrómetro), en el registro de presencia de insectos, y en la interpretación de los resultados y posibles causas / efectos de lo observado. Esta experiencia fue muy valiosa en la interacción con el productor. Las mediciones del ensayo continúan en ejecución. El principal resultado de la implementación del secadero es que se pudo interactuar con el productor, y que el mismo fue incorporando innovaciones según sus necesidades y sus propias apreciaciones. Una vez finalizado el ensayo se elaborará una guía junto al productor donde se especifiquen los aspectos más importantes aprendidos. Parte de estas experiencias fueron presentadas por el productor Walter Montenegro durante el ciclo de charlas del proyecto Universidad y Agricultura Familiar en la disertación denominada “Ser agricultor familiar en el área de secano” realizada el 28 de noviembre de 2017 en el aula de posgrado de la FAyA UNSE (Anexo IV). *Diseño de un criadero de pollos parrilleros destinado a la finca de un agricultor familiar flia. Gómez, basado en el uso de fuentes de energías renovables (Anexo II): Se compatibilizaron los criterios técnicos con los del manejo del agricultor, teniendo en cuenta los criterios de una construcción bioclimática, materiales de la zona, ubicación según la región, e incorporación de energía renovables. Para esto durante seis meses se siguió de cerca el manejo del criadero y de poco se fueron incorporando estos nuevos criterios. El productor construyó un nuevo criadero en el cual incorporó las mejoras indicadas, con la intención de duplicar la producción de pollos. Se realizó la plantación de especies nativas arbustivas tuscas (Acacia aroma), mistol del zorro (Castela coccinea) y enredaderas alrededor del criadero con la finalidad de formar un cerco vivo de protección. En relación al sistema de calefacción la propuesta inicial estaba basada en la estufa tipo SARA (diseñada por CONICET INTA) construida con materiales de fácil obtención, que además permiten absorber calor, acumularlo y entregarlo lentamente. Sin embargo, dada la falta de recursos para conseguir insumos y mano de obra, llevó a buscar alternativas a la propuesta original. En este sentido a través de un acta acuerdo firmada entre el DTEC UNSE y la Facultad de Ciencias Forestales UNSE por medio del Lab. de Energía de Biomasa se formuló una propuesta de Práctica Profesional Supervisada denominada “Diseño y construcción de un prototipo de estufa a biomasa destinada a un criadero de pollos de pequeña escala de un agricultor familiar”, lo cual permitió construir una estufa a base de biomasa (leña y marlo) modificando el diseño de la cocina tipo Rocket destinada solamente al criadero de pollos bebés. Esta alternativa a la estufa SARA es más económica y posee la ventaja de ser removible. Actualmente se está en la etapa de puesta a punto de la estufa, en la cual el productor es el encargado de controlar las cargas de combustible según sus necesidades y el manejo que realiza del criadero; además se están registrando las temperaturas interiores. El productor se mostró satisfecho con los resultados obtenidos hasta el presente con el nuevo sistema de calefacción con biomasa. En relación al sistema de iluminación a través de células fotovoltaicas, la demora en la compra de los equipos retrasó la obtención de resultados a ser transferidos al productor. Próximamente el kit fotovoltaico será medido y probado en el lab de física FCEyT UNSE. ', 'Institución pública, FAyA UNSE, Pasantía de formación en “Aprovechamiento de energía solar, utilizando tecnología tipo wickless loop heat pipe, para calentamiento de aire, orientado al secado de alimentos. Acta acuerdo de cooperación científica técnica y transferencia entre Grupo de investigación del proyecto aprovechamiento de energía solar, utilizando tecnología tipo wickless loop heat pipe, para calentamiento de aire, orientado al secado de alimentos de la Facultad de Agronomía y Agroindustrias de la Universidad Nacional de Santiago del Estero, y el Proyecto D-TEC 0016/13- Universidad Nacional de Santiago del Estero\r\n', 'Código de Perfil: DTEC 0016/13 -C5- Dr 5 \r\n• Apellido/s y Nombre/s: Figueroa María Eugenia \r\n• Lapso en el que se desempeñó : Inicio 01 / 11 / 2015 - Fin 31 / 08 / 2018 \r\n• Actividades más significativas del componente en las que participó \r\n- Planificación de las actividades del plan de trabajo del componente - Realización de Informes técnicos del Componente - Dirección y gestión de las actividades de los Paf del componente - Elaboración de Actividades y Convenios Específicos en el Marco de Actas Acuerdo \r\nfirmadas por el Proyecto DTEC UNSE - Participación en la elaboración de pliegos de Concursos de Precios por compras de \r\ninsumos y equipamientos del DTEC UNSE - Gestión y planificación de viajes en terreno y relevamientos de datos - Procesamiento de datos en gabinete - Organización de Jornadas de difusión y transferencia - Presentaciones a Jornadas y Congresos de resultados parciales del DTEC - Charlas- taller de capacitación, difusión y promoción de las energías renovables en \r\nescuelas rurales y productores - Supervisión de las actividades planificadas en la Práctica Profesional Supervisada del estudiante en Ing. en industrias forestales Sr. Iván Corbalán, denominada “Diseño y construcción de un prototipo de estufa a biomasa destinada a criadero de pollos a pequeña escala para un agricultor familiar”, en el marco del proyecto DTEC UNSE. Resol FCF N° 591/17 (Anexo Hitos 16 del informe técnico general del proyecto). - Asesoramiento del Trabajo Final de Graduación denominado “Sistema de información Web para la gestión de proyectos interdisciplinarios D-TEC UNSE” a realizar por las estudiantes de la carrera Lic. en Sistemas de Información de la FCEyT UNSE: Claudia Herrera y Gladys Fortea, en el marco del proyecto D-TEC UNSE (0016/13). Resol FCEyT N° 0043/2018 (Anexo Hitos 16 del informe técnico general del proyecto) \r\n• Actividades de formación (cursos de capacitación, otros) Anexo III \r\n- Curso Posgrado: Geoestadística. Universidad Nacional de Córdoba. Escuela para \r\ngraduados. Facultad de Agronomía. 28 de mayo al 1 de junio del 2018. - Curso Posgrado: Diversidad Funcional. Universidad Nacional de Córdoba. Facultad de \r\nCiencias Exactas y Naturales. 2015 \r\n', 'Código de Perfil: DTEC 0016/13 -C5- PAF 9 \r\n• Apellido/s y Nombre/s: Vidal Julia Teresita \r\n• Lapso en el que se desempeñó : Inicio 1/11/ 2015 - Fin 31/08/ 2018 \r\n• Actividades más significativas del componente en las que participó \r\n- Diseño de un criadero de pollos eficiente - Diseño de un secadero tipo casilla - Guía de elaboración de una estufa Sara para el criadero de pollos - Elaboración de las actividades planificadas en el marco del Acta Acuerdo firmada por el proyecto DTEC UNSE junto al grupo de trabajo del proyecto Aprovechamiento de energíasolar, utilizando tecnología tipo wickless loop heat pipe de la Facultad de Agronomía y Agroindustrias de la UNSE a cargo del profesor Carlos Cattaneo. - Gestión de donación de postes de eucaliptos creosotados para la construcción de un \r\ncomedero de cabra para el componente C2 - Participación en relevamientos de datos en campo - Procesamiento de datos en laboratorio y gabinete - Realización de informes técnicos para el componente - Charlas taller de capacitación, difusión y promoción de las energías renovables en \r\nescuelas rurales y productores - Presentaciones a Jornadas y Congresos de resultados parciales de la componente y DTEC. \r\n• Actividades de formación (cursos de capacitación, otros) Anexo III \r\n- Asistente Curso de entrenamiento sobre Uso y Funcionamiento del equipo marca Holaday Modelo HI-6053 y su Sofware ProbeView II, realizado el 18 de diciembre de 2017 en la Universidad Nacional de Santiago del Estero - Asistente Curso de entrenamiento del equipo de Ensayos Primarios CPC100 y Modulo de Tangente Delta CP TD1 de Omicrom, dictado el 21 y 22 de noviembre de 2017 en la Universidad Nacional de Santiago del Estero, cede Parque Industrial, La Banda. - Asistente Curso de entrenamiento sobre Uso y Funcionamiento del equipo Calibrador Multifunción marca MEATEST modelo MT - 140 dictado el 14 y 15 de noviembre de 2017 en la Universidad Nacional de Santiago del Estero, cede Parque Industrial, La Banda. - Asistente Curso de MTE-F3-20.10-400S-CI.0.05-ITC-QCD I Mesa Patrón para 10 posiciones; y PTS 400.3-120 A PLUS Equipo Trifásico Portátil de Ensayo y CALegration Paquete de software, dictado el 23 y 27 de Octubre de 2017 en la Universidad Nacional de Santiago del Estero, cede Parque Industrial, La Banda. - Asistente Conferencia de “Curricularización de la extensión”, coordinado por Dr. Daniel Micheli en el marco del proyecto: “Un paso hacia la universidad que queremos: cirricularización de la extensión de la UNSE” correspondiente al Programa de Fortalecimiento de Capacidades de extensión, Resolución SPN N° 2370/16, realizado el 3 de julio de 2017por total de 4hs reloj en el Paraninfo de la Universidad Nacional de Santiago del Estero - Asistente Charla técnica “Nuevos conductores eficientes de alta temperatura y baja flecha” Desarrollado en la Universidad Nacional de Santiago del Estero, Facultad de Ciencias Exactas y Tecnologías, Parque Industrial. 14 de junio 2017. - Curso de posgrado: THERMAL/ INFRARED THERMOGRAPHY- Electrical/ Mechanical Specifie, Level I- Dictado por Snell Group. Is certificade to have successfully completed a thirty- four hour course of study and have passed general, specific, and practical examination for. Octubre 2016. - Curso de Capacitación para utilización de equipos de ensayo con tensión inducida. Facultad de Ciencias Exactas y Tecnologías, Universidad Nacional de Santiago del Estero. 4 hs de Teoría y 4 hs de Práctica. 10 de agosto de 2016. Aprobado. - Curso de Capacitación Manejo de cámaras termográficas FLUKE. Aprobado. Facultad de Ciencias Exactas y Tecnologías, Universidad Nacional de Santiago del Estero. 8 y 9 de agosto de 2016. - Pasantía en Aprovechamiento de energía solar, utilizando tecnología tipo wickless loop heat pipe, para calentamiento de aire, orientado al secado de alimentos- Acta acuerdo proyecto FAyA UNSE y DTEC UNSE (Anexo Hitos 16 del informe técnico general del proyecto). - Disertante en 4ta Jornada de seguridad eléctrica en instalaciones eléctricas. Santiago del Estero FORUM de la Provincia de Santiago del Estero. Resolución AD F.C.E.yT. 332/16. 23 de junio de 2016.', 'La particularidad del proyecto de estar conformado por un equipo de 18 becarios con diferentes formaciones disciplinares, trabajando en terreno con cuatro tipos de pequeños productores familiares, con diferentes realidades socioeconómicas y en contextos ecológicos y ambientales diferentes, significó un gran desafío para el trabajo en equipo y toma de decisiones sobre las líneas de acción e intervención en campo. Cabe destacar, por lo mencionado, que el trabajo desarrollado significó un arduo proceso de aprendizaje, discusiones y adaptaciones desde las formas de trabajo, coordinación, cooperación, adecuación de lenguajes técnicos y conceptualizaciones de la realidad dentro del equipo y entre el equipo y los productores. El trabajo fundamental y destacable de este proyecto fue la continua presencia del equipo en elterreno, interactuando con el productor y su familia, siguiendo de cerca sus actividades cotidianas y retroalimentando propuestas técnicas, conceptos e ideas. El trabajo desde la componente 5 estuvo enfocado en el proceso más que en los productos, dónde el objetivo fue acercar al productor propuestas de sustentabilidad energética con opciones disponibles en su entorno, valorando las ventajas y dificultades para la implementación de las energías renovables, todo lo cual supone un proceso con efectos de mediano y largo plazo. Si bien las dificultades en la ejecución de las propuestas dadas por factores externos y ajenos a la componente, retrasaron su desarrollo, la predisposición y apertura de productores, junto a la colaboración de la UNSE, permitió minimizar estos retrasos y continuar con las actividades. ', 'Anexo I: Plan de trabajo Componente 5 y planilla Hitos SMP Anexo II: Informes técnicos \r\nA II.1. Informe de requerimientos energéticos, análisis de huella de carbono e indicadores de sustentabilidad energética\r\nA II.2. Propuesta de diseño de criadero eficiente A II.3. Prefactibilidad para la implementación de destiladores solares A II.4. Diseño y construcción de un termotanque solar para precalentamiento de agua en procesos de agricultura familiar A II.5. Evaluación de recurso renovable del emplazamiento Anexo III: Certificaciones: Cursos- Integración de proyectos de investigación- \r\nPublicaciones-Disertaciones Anexo IV: Actas acuerdo firmadas', NULL, NULL),
(3, '2019', 15, 'Nacional de Santiago del estero', 'DTEC', 5, 6, '2021-08-10 00:00:00', '2019-06-08 00:00:00', '<h2 style=\"text-align:center;\">Lorem ipsum dolor sit amet,&nbsp;</h2><p style=\"text-align:center;\"><i>consectetur adipiscing elit.&nbsp;</i></p><p style=\"text-align:center;\">&nbsp;</p><blockquote><p>Proin mollis ut odio nec posuere. Maecenas libero diam, gravida vel accumsan quis,euismod vitae erat. Donec ut turpis ac ligula sagittis tempor. Vestibulum pulvinar ligula nec sapien iaculis, sed blandit magna ullamcorper.&nbsp;</p></blockquote><p><strong><u>Quisque in metus ac sapien consectetur tincidunt.&nbsp;</u></strong></p><p><i>Quisque molestie cursus felis, et vestibulum erat eleifend eu. Donec gravida ex ac velit eleifend, et fringilla magna auctor. Fusce non ultrices est, et tempor dui. Mauris sagittis quam sed purus porta pellentesque. Sed ultricies odio dolor, sit amet feugiat risus elementum et.&nbsp;</i></p>', '<p>Cras odio quam, eleifend tempor molestie vel, lacinia quis lectus. Morbi vel quam nec magna euismod euismod. Sed pulvinar dui nec consequat facilisis. Proin vitae libero ac dui maximus vestibulum. Ut justo nisi, faucibus at malesuada suscipit, sagittis eu diam. Ut eget posuere ex. Nunc lobortis pharetra enim eu suscipit. Duis tincidunt ac sem vel iaculis. Aenean leo enim, sodales in ligula eget, ultricies pulvinar ex. Nulla ac leo ante. Duis mattis cursus efficitur. Duis mollis ligula neque, ac congue ante dignissim nec. Suspendisse odio tortor, suscipit ut massa sit amet, posuere vulputate tortor. Nulla elementum ipsum sit amet justo aliquet rhoncus. Nunc in mauris sollicitudin, eleifend felis ac, ultrices nibh. Phasellus nec metus diam.&nbsp;</p>', '<p>Praesent lacinia, augue eget pretium condimentum, orci nibh malesuada tortor, at euismod nisl eros sit amet sapien. Vivamus molestie quam aliquet elit tempus, vitae placerat enim tempor. Curabitur vel mi sit amet velit ultricies sodales et quis diam. Ut malesuada aliquet egestas. Quisque suscipit tellus at nunc lobortis, non semper eros mattis. Sed justo risus, porta quis posuere id, vehicula eget justo. Maecenas molestie egestas ex, eget iaculis urna condimentum id. Mauris finibus urna at ex tincidunt, in congue augue tincidunt. Proin viverra condimentum erat, ut interdum leo porta sit amet. Donec mattis dui a sapien varius, vel iaculis sapien volutpat. Praesent erat tellus, euismod ut eleifend et, sodales eu orci. Proin quis lorem arcu. Nullam at mauris venenatis, porttitor neque in, pretium ligula.&nbsp;</p>', '<p>Aliquam vestibulum pharetra erat, congue interdum massa pulvinar id. Quisque lobortis posuere massa, sit amet tempus leo consectetur nec. Sed pulvinar tellus at erat maximus, ut imperdiet lorem egestas. Duis felis nunc, interdum ac tortor in, placerat sollicitudin sapien. In eget lorem vitae elit accumsan iaculis vel et magna. Phasellus a ante sed ante hendrerit imperdiet a eget ipsum. Vivamus a ornare quam. Cras euismod risus tellus, a pretium erat sollicitudin eu. Sed dignissim neque nibh, eu mollis sem mollis eu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam scelerisque ligula quis neque viverra porta.&nbsp;</p>', '<p>Vivamus tempus scelerisque molestie. Quisque ornare porttitor diam, eget efficitur neque consectetur id. Aenean sollicitudin tristique euismod. Praesent tellus leo, tristique sed purus sed, dapibus tempus purus. Curabitur rutrum magna purus, vitae sagittis dolor elementum blandit. Sed hendrerit tempor ullamcorper. Suspendisse nisl orci, laoreet eget risus vel, ullamcorper rutrum lacus. Fusce mi odio, vestibulum sed arcu eget, tristique lobortis nulla. Ut a mollis tortor.&nbsp;</p>', '<p>Donec rhoncus malesuada ipsum non vehicula. Phasellus vel faucibus neque, in elementum justo. Quisque felis massa, convallis nec iaculis ac, pharetra nec diam. Phasellus tristique tristique massa ut egestas. Donec commodo laoreet orci a feugiat. In eu tincidunt nibh. In sed pulvinar neque. Aenean eget pellentesque elit. Fusce facilisis eleifend lobortis. Pellentesque eget rhoncus lacus. Suspendisse sit amet volutpat purus. Sed ullamcorper gravida lacus ut porttitor. Sed aliquam molestie odio vitae malesuada. Donec vel rhoncus odio. Ut vehicula enim efficitur neque consequat egestas.&nbsp;</p>', '<p>Aliquam eget accumsan est. Nulla pretium viverra tincidunt. Pellentesque lorem mi, elementum in lectus sed, consectetur ultrices dui. Donec laoreet, eros vel ultrices suscipit, massa justo elementum nisi, eu malesuada eros nisl sed quam. Fusce non ultrices metus. Pellentesque non risus eleifend, pulvinar sapien eu, ullamcorper ipsum. Suspendisse tincidunt hendrerit justo vitae dignissim. Morbi ullamcorper urna lacus, iaculis vehicula nisi iaculis et. Morbi eleifend erat dictum, eleifend orci at, vestibulum sapien. Cras sagittis orci velit, vel laoreet mauris semper a. Maecenas dignissim erat vel ornare condimentum. Donec commodo nisl non iaculis mollis. In iaculis semper lectus. Aenean et urna sem. Sed blandit tempor volutpat. Curabitur vitae magna ornare, eleifend diam vitae, placerat ipsum.&nbsp;</p>', '<p>Nulla tempus vehicula libero, eget blandit magna blandit eget. Pellentesque sem nisl, iaculis vitae libero sed, molestie fringilla elit. Duis sed diam ex. Aenean rhoncus egestas rutrum. Vestibulum sodales aliquet dolor id accumsan. Ut eget neque vulputate, congue lectus ut, feugiat ipsum. Donec bibendum metus eu sem volutpat, ut molestie ipsum malesuada. Duis gravida ligula lectus, id sodales nunc tempor at.&nbsp;</p>', '<p>Nunc aliquet vel velit vitae placerat. Nulla pretium, sem vel tincidunt hendrerit, nisi tellus aliquet turpis, a cursus sem orci vel diam. In hac habitasse platea dictumst. Etiam commodo sem nec orci dignissim, eu fringilla ex interdum. Vivamus tempus lacinia metus. Vestibulum consectetur purus ac commodo condimentum. Vestibulum tempus sapien sit amet ex placerat dictum. Etiam non nibh quis dui sagittis scelerisque.&nbsp;</p>', '<p>Nullam tincidunt, lorem in congue dapibus, nisl dui ornare magna, quis mollis purus velit et elit. Aliquam feugiat maximus sem, vitae efficitur mauris ultricies eget. Vestibulum scelerisque pharetra sapien, in viverra felis mattis id. Maecenas facilisis, dolor at semper mattis, elit sapien gravida urna, nec elementum nunc orci ultrices lorem. Integer maximus lectus ac orci varius, a blandit nulla venenatis. Ut eu pretium ex. Duis ut mattis nunc, posuere porttitor dui. Suspendisse tincidunt at quam sit amet tincidunt. Mauris vel blandit leo, in laoreet velit. Phasellus quis felis ac ante lacinia hendrerit ut ac enim. Vestibulum ut maximus libero. Suspendisse magna quam, cursus vel ultrices eget, malesuada quis lectus. Quisque aliquam arcu purus, ut rhoncus metus vulputate tincidunt. Praesent vitae dapibus turpis, vel congue nunc. Cras vitae lacinia felis.&nbsp;</p>', '2020-07-09 21:37:15', '2020-07-21 13:35:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_avances_becarios`
--

DROP TABLE IF EXISTS `informes_avances_becarios`;
CREATE TABLE IF NOT EXISTS `informes_avances_becarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `informe_avance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_avance_id` (`informe_avance_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes_avances_becarios`
--

INSERT INTO `informes_avances_becarios` (`id`, `usuario_id`, `informe_avance_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(8, 4, 3),
(9, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_comunes`
--

DROP TABLE IF EXISTS `informes_comunes`;
CREATE TABLE IF NOT EXISTS `informes_comunes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT '0',
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes_comunes`
--

INSERT INTO `informes_comunes` (`id`, `titulo`, `texto`, `aprobado`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'Ficha de Revelamiento de campo para C5', '<h2 style=\"text-align:center;\">Agua</h2><ol><li>origen</li><li>calidad</li><li>consumo/tiempo</li><li>destino</li></ol><h3>Capital Humano</h3><p>1- N° horas que trabaja<br>2- N° personas que trabajan<br><br>Energia<br>1-Fuente de energia utilizada: gas natural- gasoil-leña-carbon- energia electrica<br>2-consumo por tipo de energia<br>3-autoconsumo(gastos) y gastos en el hogar<br>4- instalaciones<br><br>Principales Producciones<br>1- superficie ocupada por cada actividad productiva<br>2- lista de actividades productivas<br>3- cantidad producida<br>4-energia que consume cada actividad<br>5-rentabilidad obtenida<br>6- tipo de desechos generados<br>7- cantidad de desechos por tipo de desechos<br>8- cantidad de personas encargadas por actividad<br>9- consumo de agua por actividad<br><br>Maquinas/Herramientas<br>1- tipo de maquinaria<br>2- capacidad de trabajo del equipo<br>3- tipo de energia que utiliza<br>4- frecuencia de uso<br>5- costo de manteniemmiento de la maquina</p>', 0, 2, NULL, '2020-07-16 00:52:45'),
(2, 'Nuevo informe Común', '<div class=\"wysiwyg-text-align-right\">Miércoles 10 de Junio de 2020</div><div class=\"wysiwyg-text-align-right\"><br></div><h1 class=\"wysiwyg-text-align-center\">Lorem ipsum dolor sit amet, <br></h1><div><br></div><div><b>consectetur adipiscing elit. Maecenas tempor<br> tortor massa,</b> eget elementum metus vestibulum quis. <br></div><div><br></div><div><ul><li>Donec finibus at <br>tellus a hendrerit. Cras hendrerit pulvinar velit sagittis luctus. <br></li><li>Sed <br>accumsan magna quis purus consequat tempus. Suspendisse lectus enim, <br>tristique eget <br></li><li>scelerisque sed, bibendum sit amet est. Ut sagittis <br>maximus imperdiet. Aenean nec dolor rhoncu</li></ul><u>vehicula lectus a, <br>condimentum odio. Sed pulvinar magna id rutrum rutrum. </u><br></div><div><br></div><blockquote><div><i>Duis nec sodales <br>risus. Nunc urna urna, sodales ac nisl iaculis, ultrices efficitur nibh. </i><br></div><div>Proin elementum lacus sem, id ornare mi viverra eget. Fusce <br>pellentesque arcu tellus, nec rutrum dolor pharetra a. Cras ac imperdiet<br> ex, in finibus neque.<br></div></blockquote>', 0, 2, '2020-06-02 01:14:02', '2020-06-10 03:31:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_comunes_imagenes`
--

DROP TABLE IF EXISTS `informes_comunes_imagenes`;
CREATE TABLE IF NOT EXISTS `informes_comunes_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_comun_id` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_comun_id` (`informe_comun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes_comunes_imagenes`
--

INSERT INTO `informes_comunes_imagenes` (`id`, `informe_comun_id`, `imagen`) VALUES
(1, 1, 'flia_huerta.jpg'),
(20, 2, 'Paisajes (1).jpg'),
(21, 2, 'Paisajes (45).jpg'),
(22, 2, 'Paisajes (42).jpg'),
(23, 2, 'Paisajes (60).jpg'),
(24, 2, 'Plantas (39).jpg'),
(25, 2, 'Plantas (36).jpg'),
(26, 1, 'animales_01.jpg'),
(27, 1, 'animales_05.jpg'),
(29, 1, 'animales_21.jpg'),
(30, 1, 'animales_11.jpg'),
(31, 1, 'animales_29.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_hitos`
--

DROP TABLE IF EXISTS `informes_hitos`;
CREATE TABLE IF NOT EXISTS `informes_hitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `universidad` varchar(100) NOT NULL,
  `proyecto` varchar(100) NOT NULL,
  `componente` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes_hitos`
--

INSERT INTO `informes_hitos` (`id`, `universidad`, `proyecto`, `componente`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'Universidad Nacional de Santiago del Estero', 'D-TEC 0016/13', 5, 4, NULL, NULL),
(2, 'UNiversidad Nacional de Santiago del estero', 'D-TEC 0016/13', 5, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_indicadores`
--

DROP TABLE IF EXISTS `informes_indicadores`;
CREATE TABLE IF NOT EXISTS `informes_indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicador_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indicador_id` (`indicador_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `finca_id` (`finca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes_indicadores`
--

INSERT INTO `informes_indicadores` (`id`, `indicador_id`, `valor`, `finca_id`, `fecha`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2016-03-17 00:00:00', 5, NULL, NULL),
(2, 2, 3, 1, '2016-03-17 00:00:00', 5, NULL, NULL),
(3, 3, 3, 1, '2016-03-17 00:00:00', 5, NULL, NULL),
(4, 4, 2, 1, '2016-03-17 00:00:00', 5, NULL, NULL),
(5, 5, 0, 1, '2016-03-17 00:00:00', 5, NULL, NULL),
(6, 6, 1, 1, '2016-03-17 00:00:00', 5, NULL, NULL),
(7, 1, 1, 2, '2016-03-17 00:00:00', 5, NULL, NULL),
(8, 2, 3, 2, '2016-03-17 00:00:00', 5, NULL, NULL),
(9, 3, 2, 2, '2016-03-17 00:00:00', 5, NULL, NULL),
(10, 4, 3, 2, '2016-03-17 00:00:00', 5, NULL, NULL),
(11, 5, 0, 2, '2016-03-17 00:00:00', 5, NULL, NULL),
(12, 6, 0, 2, '2016-03-17 00:00:00', 5, NULL, NULL),
(13, 1, 3, 3, '2016-03-17 00:00:00', 5, NULL, NULL),
(14, 2, 1, 3, '2016-03-17 00:00:00', 5, NULL, NULL),
(15, 3, 30, 3, '2016-03-17 00:00:00', 5, NULL, NULL),
(16, 4, 0, 3, '2016-03-17 00:00:00', 5, NULL, NULL),
(17, 5, 1, 3, '2016-03-17 00:00:00', 5, NULL, NULL),
(18, 6, 1, 3, '2016-03-17 00:00:00', 5, NULL, NULL),
(19, 1, 0, 4, '2016-03-17 00:00:00', 5, NULL, NULL),
(20, 2, 0, 4, '2016-03-17 00:00:00', 5, NULL, NULL),
(21, 3, 0, 4, '2016-03-17 00:00:00', 5, NULL, NULL),
(22, 4, 0, 4, '2016-03-17 00:00:00', 5, NULL, NULL),
(23, 5, 3, 4, '2016-03-17 00:00:00', 5, NULL, NULL),
(24, 6, 3, 4, '2016-03-17 00:00:00', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT '0',
  `tipo_nota_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_nota_id` (`tipo_nota_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `titulo`, `contenido`, `fecha`, `aprobado`, `tipo_nota_id`, `usuario_id`) VALUES
(1, 'Informes trimestrales de mayo-junio del 2017', '<p style=\"text-align:right;\">Santiago de Estero, 2 de agosto de 2017&nbsp;</p><p>A la Dirección del proyecto DTEC-UNSE&nbsp;<br><strong>Ing. M. Sc. Ada Albanesi S/D&nbsp;</strong></p><p style=\"margin-left:200px;\">Por la presente elevo los informes trimestrales de mayo-junio del 2017, elaborados por los PAF del Componente 5, según las actividades programadas para ese periodo. Sin otro motivo, me despido cordialmente .</p><p>Maria Eugenia Figueroa&nbsp;<br><i><sub>Dra. Responsable del Componente 5</sub></i></p>', '2020-07-15 22:16:59', 0, 2, 4),
(2, 'Solicitud autorización para realizar un viaje', 'Santiago del Estero, 26 de junio de 2018\r\nDiretora del Proyecto D-TEC 2013 N° 0016/13\r\nIng. M. Sc. Ada Albanesi\r\nS/D\r\nDe mi mayor consideración:\r\nPor la presente se solicita autorización para realizar un viaje de campaña por la C5 en el marco del proyecto D-TEC 0016/13, en la localidad Sta. Isabel Dpto Atamisqui el día 29 del corriente mes. El viaje se programó con salida a las 8:00hs, y el regreso estimado es a las 14hs. El viaje se realizará en vehiculo de FCF UNSE.\r\nLa comisión estará formada por los siguientes integrantes:\r\n1. Ing. Andrea Natalia Giménez DNI 34956288\r\n2. Ing. Teresita Vidal DNI 26284200\r\n3. Sr. Mario Bernardo Berton DNI 29894378\r\n4. Ing. Pablo Fernández DNI 24101528\r\n5. Dra. Maria Eugenioa Figueroa DNI 30316565 (conductor)\r\nSin otro particular me despido de Ud. atentemente.\r\n\r\nMaria Eugenia Figueroa', '2018-06-26 00:00:00', 0, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'notas_crear', 'Crear notas'),
(2, 'notas_editar', 'Editar notas'),
(3, 'notas_eliminar', 'Eliminar notas'),
(4, 'notas_aprobar', 'Aprobar notas'),
(5, 'tipo_notas_crear', 'Crear tipos de notas'),
(6, 'tipo_notas_editar', 'Editar tipos de notas'),
(7, 'tipo_notas_eliminar', 'Eliminar tipos de notas'),
(8, 'tipo_notas_aprobar', 'Aprobar tipos de notas'),
(9, 'informes_comunes_crear', 'Crear informes comunes'),
(10, 'informes_comunes_editar', 'Editar informes comunes'),
(11, 'informes_comunes_eliminar', 'Eliminar informes comunes'),
(12, 'informes_comunes_aprobar', 'Aprobar informes comunes'),
(13, 'informes_hitos_crear', 'Crear informes hitos'),
(14, 'informes_hitos_editar', 'Editar informes hitos'),
(15, 'informes_hitos_eliminar', 'Eliminar informes hitos'),
(16, 'informes_hitos_aprobar', 'Aprobar informes hitos'),
(17, 'informes_indicadores_crear', 'Crear informes indicadores'),
(18, 'informes_indicadores_editar', 'Editar informes indicadores'),
(19, 'informes_indicadores_eliminar', 'Eliminar informes indicadores'),
(20, 'informes_indicadores_aprobar', 'Aprobar informes indicadores'),
(21, 'informes_avances_crear', 'Crear informes avances'),
(22, 'informes_avances_editar', 'Editar informes avances'),
(23, 'informes_avances_eliminar', 'Eliminar informes avances'),
(24, 'informes_avances_aprobar', 'Aprobar informes avances'),
(25, 'usuarios_crear', 'Crear usuarios'),
(26, 'usuarios_editar', 'Editar usuarios'),
(27, 'usuarios_eliminar', 'Eliminar usuarios'),
(28, 'roles_crear', 'Crear roles'),
(29, 'roles_editar', 'Editar roles'),
(30, 'roles_eliminar', 'Eliminar roles'),
(31, 'enviar_correos', 'Enviar correos'),
(32, 'imprimir_exportar', 'Imprimir y exportar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Administrador del sistema'),
(2, 'Director', 'Director del proyecto'),
(3, 'Responsable componente', 'Responsable del componente'),
(4, 'PAF', 'PAF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

DROP TABLE IF EXISTS `roles_permisos`;
CREATE TABLE IF NOT EXISTS `roles_permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`id`, `rol_id`, `permiso_id`) VALUES
(4, 3, 3),
(5, 3, 7),
(6, 3, 4),
(7, 3, 8),
(8, 3, 11),
(9, 3, 12),
(10, 3, 15),
(11, 3, 16),
(12, 3, 19),
(13, 3, 20),
(14, 3, 23),
(15, 3, 24),
(16, 3, 25),
(17, 3, 26),
(18, 3, 27),
(19, 3, 28),
(20, 3, 29),
(21, 3, 30),
(22, 4, 3),
(23, 4, 4),
(24, 4, 7),
(25, 4, 8),
(26, 4, 11),
(27, 4, 12),
(28, 4, 15),
(29, 4, 16),
(30, 4, 20),
(33, 4, 13),
(34, 4, 14),
(35, 4, 19),
(36, 4, 21),
(37, 4, 22),
(38, 4, 23),
(39, 4, 24),
(40, 4, 25),
(41, 4, 26),
(42, 4, 27),
(43, 4, 28),
(44, 4, 29),
(45, 4, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_notas`
--

DROP TABLE IF EXISTS `tipo_notas`;
CREATE TABLE IF NOT EXISTS `tipo_notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_notas`
--

INSERT INTO `tipo_notas` (`id`, `descripcion`) VALUES
(1, 'permiso para viajes de campo'),
(2, 'elevación de actividades trimestrales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_perfil` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `domicilio`, `codigo_perfil`, `rol_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Karina Herrera', 'karinaherrera@gmail.com', NULL, NULL, 1, NULL, '$2y$10$Qh4iWBvcO7jb8nmg2h6wkuYAuINsBcQMnqQ40ouTqQ5YFb4Z0.Cni', NULL, '2020-03-16 16:58:07', '2020-03-16 16:58:07'),
(3, 'Gladys Fortea', 'gladysfortea@gmail.com', 'barrio fraternidad', NULL, 1, NULL, '$2y$10$.VU9fXpEQMT56neRiX0L4OwwgIzH7UEI1h.5C0aLUmLNWsArjMnia', NULL, NULL, NULL),
(4, 'Eugenia Figueroa', 'meugeniaf83@gmail.com', 'barrio Ramon Carrillo', 'D-TEC 0016/13-C5-DR ', 3, NULL, '$2y$10$FPaPXY/EEpOFvpvKuxote.laX0iFFeivoPRT7vflnnSMjjF53yPVW', NULL, NULL, NULL),
(5, 'Teresita Vidal', 'teresitavidal@gmail.com', 'barrio Ramon Carrillo', 'D-TEC 0016/13-C5- PA', 4, NULL, '$2y$10$sj4dMZ3BL7jkWsy299ZW2ODdAbgQGTb1LwgTQ9ZRqo0c2rfvomzQK', NULL, NULL, NULL),
(6, 'Ada Albanesi', 'adaalbanesi@gmail.com', 'barrio Ramon Carrillo', NULL, 2, NULL, '$2y$10$cHqbQ8qd6FibX3J4jF1TC.SxrpJxhNNILjvRJIS59Aj.dwEwHCavi', NULL, NULL, NULL),
(7, 'Franco Raul Fernández', 'francofernadez@gmail.com', 'barrio Ramon Carrillo', 'D-TEC 0016/13-C5-PAF 10', 4, NULL, '$2y$10$oqLHq5W9bKFRYZlvg13EX.WL2qZSbx/7QYVGCU3S52sfkncKeX.PK', NULL, NULL, '2020-05-24 04:39:19'),
(8, 'Usuario DEMO', 'demo@demo.com', '9 de Julio 1000', 'D-TEC 0016/13-C5-PAF 10', 4, NULL, '$2y$10$pQQEG6xZISLug2cxnaOBGOVW5rkFeSKAPgwS9kRgVTaX2DDb5gH8S', NULL, '2020-07-21 21:41:08', '2020-07-21 21:41:08');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hitos`
--
ALTER TABLE `hitos`
  ADD CONSTRAINT `hitos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `indicadores_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `indicadores_categorias` (`id`);

--
-- Filtros para la tabla `informes_avances`
--
ALTER TABLE `informes_avances`
  ADD CONSTRAINT `informes_avances_ibfk_1` FOREIGN KEY (`director_proyecto_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_avances_becarios`
--
ALTER TABLE `informes_avances_becarios`
  ADD CONSTRAINT `informes_avances_becarios_ibfk_1` FOREIGN KEY (`informe_avance_id`) REFERENCES `informes_avances` (`id`),
  ADD CONSTRAINT `informes_avances_becarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_comunes`
--
ALTER TABLE `informes_comunes`
  ADD CONSTRAINT `informes_comunes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_comunes_imagenes`
--
ALTER TABLE `informes_comunes_imagenes`
  ADD CONSTRAINT `informes_comunes_imagenes_ibfk_1` FOREIGN KEY (`informe_comun_id`) REFERENCES `informes_comunes` (`id`);

--
-- Filtros para la tabla `informes_hitos`
--
ALTER TABLE `informes_hitos`
  ADD CONSTRAINT `informes_hitos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_indicadores`
--
ALTER TABLE `informes_indicadores`
  ADD CONSTRAINT `informes_indicadores_ibfk_1` FOREIGN KEY (`indicador_id`) REFERENCES `indicadores` (`id`),
  ADD CONSTRAINT `informes_indicadores_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `informes_indicadores_ibfk_4` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`tipo_nota_id`) REFERENCES `tipo_notas` (`id`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
