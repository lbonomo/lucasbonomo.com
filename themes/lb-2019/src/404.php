<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package lb19
 */

get_header();

$mensajes404 = [
	"Bueno, esto es incómodo... La página decidió tomarse el día libre.",
	"404: Página desaparecida como mi dieta los fines de semana.",
	"Esto no es lo que buscabas, pero aquí estamos, juntos en el error.",
	"¡Rayos! La página se escapó por la ventana.",
	"Alguien escondió esta página... y no nos dijo dónde.",
	"La página que buscas está en otro castillo.",
	"Oops, esto es más vacío que mi refrigerador un domingo por la noche.",
	"Nuestra página tomó el camino menos transitado... y se perdió.",
	"404: La página fue a comprar cigarrillos y nunca volvió.",
	"¿Página? ¿Cuál página? Aquí no hay nada, solo un abismo digital.",
	"Hemos buscado en todos los rincones, pero no hay rastro de la página.",
	"Esta página está más perdida que yo en una clase de yoga avanzado.",
	"404: Al parecer, esta página se tomó vacaciones permanentes.",
	"Oops... ¿Esto es un error o arte contemporáneo?",
	"Buscamos esta página en Google y tampoco la encontramos.",
	"Esta página está jugando a las escondidas... y está ganando.",
	"Lo sentimos, pero la página decidió no trabajar hoy.",
	"404: Como tu ex, esta página se ha ido sin dejar rastro.",
	"Esto está más roto que mi celular después de una caída.",
	"¡Ups! Parece que pisamos una cáscara de error.",
	"La página no está aquí, pero tienes nuestra simpatía.",
	"404: Página no encontrada. ¿Probaste apagar y encender?",
	"Esto es tan vacío como mi cuenta bancaria a fin de mes.",
	"404: Este link está más roto que mis sueños de niño.",
	"Oops, esto está más perdido que turista sin GPS.",
	"404: Error, pero con estilo.",
	"Esta página no existe, pero seguro que eres genial.",
	"404: Esta página se autodestruyó para evitar preguntas incómodas.",
	"Esto es un mensaje de error, pero al menos no es un lunes.",
	"Ups, esta página se cayó del mapa. Literalmente.",
	"404: Tu curiosidad es admirable, pero aquí no hay nada.",
	"Esto es como buscar una aguja en un pajar... sin pajar.",
	"404: Página no encontrada. Seguramente estaba aburrida.",
	"Esto no es un error, es una obra maestra de la frustración.",
	"404: Página en huelga. Reclama mejores servidores.",
	"Nos encantaría ayudarte, pero la página no nos dejó pista alguna.",
	"Esto está más roto que mi corazón después de ver mi factura de internet.",
	"404: Este error es cortesía del club de la procrastinación.",
	"La página que buscas no está, pero la intención cuenta.",
	"Esto está más vacío que mi lista de cosas hechas hoy.",
	"Ups... ¡404 y un café, por favor!",
	"Bueno, esto es incómodo... La página decidió tomarse el día libre.",
	"404: Página desaparecida como mi dieta los fines de semana.",
	"Esto no es lo que buscabas, pero aquí estamos, juntos en el error.",
	"¡Rayos! La página se escapó por la ventana.",
	"Alguien escondió esta página... y no nos dijo dónde.",
	"La página que buscas está en otro castillo.",
	"Oops, esto es más vacío que mi refrigerador un domingo por la noche.",
	"Nuestra página tomó el camino menos transitado... y se perdió.",
	"404: La página fue a comprar cigarrillos y nunca volvió.",
	"¿Página? ¿Cuál página? Aquí no hay nada, solo un abismo digital.",
	"Parece que esta página se olvidó de venir a trabajar hoy.",
	"Este lugar está más vacío que una fiesta sin música.",
	"La página que buscas está de vacaciones en un lugar mejor.",
	"404: Página extraviada en el ciberespacio.",
	"¡Boom! Encontraste la nada misma, felicidades.",
	"Esta página estaba aquí, pero luego dijo 'brb' y nunca volvió.",
	"Como tu ex, esta página ya no está disponible.",
	"404: Página perdida como yo en clases de matemáticas.",
	"La página se escondió mejor que un calcetín perdido en la lavadora.",
	"Ups, la página se desintegró como un villano de Marvel.",
	"Aquí no hay nada... ¿Quieres intentar en Mordor?",
	"404: Página perdida, pero seguro está tomando mate por ahí.",
	"La página que buscas está más lejos que un viernes a las 8 a.m.",
	"404: Esto está más vacío que una olla después de un asado.",
	"La página fue a buscar respuestas y aún no volvió.",
	"404: Página desaparecida, se busca viva o cargada.",
	"¡Ups! Parece que esta página está en modo ninja.",
	"404: La página decidió cambiar de carrera.",
	"Esto no es un error, es una obra de arte minimalista.",
	"La página que buscas está en otro universo paralelo.",
	"404: Página no encontrada, pero deja tu mensaje después del beep.",
	"Esto no es lo que buscabas, pero... hola.",
	"Esta página se fue a hacer algo más importante, como dormir.",
	"404: ¿Has probado apagar y encender tu WiFi?",
	"Esto es más raro que encontrar dinero en tus jeans viejos.",
	"La página se cansó y se fue a tomar un café.",
	"404: Nada por aquí, nada por allá.",
	"La página decidió explorar el mundo, comenzando por no estar aquí.",
	"404: Página no encontrada, pero mira qué lindo error.",
	"Esta página está más desaparecida que un amigo después de pedirle ayuda para mudarte.",
	"404: Página fuera de servicio, vuelva pronto... o no.",
	"Aquí debería haber una página, pero se fugó con el servidor.",
	"404: La página se fue corriendo y nadie sabe por qué.",
	"Esto está tan vacío como mis ganas de trabajar un lunes.",
	"404: Página encontrada, pero luego se perdió de nuevo.",
	"¡Oh no! Esto no era lo que esperabas, ni yo tampoco.",
	"404: ¿Te puedo interesar en una suscripción a Netflix en lugar de esta página?",
	"La página se fue al supermercado y no volvió.",
	"Esto no es lo que buscabas, pero al menos es original.",
	"404: Esto es más misterioso que un episodio de *Lost*.",
	"La página fue absorbida por un agujero negro digital.",
	"404: Este error es cortesía de nuestra falta de organización.",
	"¿Y si la página se escondió en el código fuente?",
	"404: Página perdida, pero puedes intentarlo con fe.",
	"Esto está tan vacío como mi bandeja de entrada después del viernes.",
	"La página fue a buscar inspiración... claramente la necesita.",
	"404: Este error es gratis, ¡de nada!",
	"¿Página no encontrada? Quizás nunca existió...",
	"Esto está más roto que mi autoestima después de un lunes largo.",
	"404: La página tomó un desvío... y nunca regresó.",
	"Esto no es lo que buscabas, pero míralo por el lado bueno: ¡es único!",
	"404: Página fuera de cobertura, intente más tarde.",
	"¿Página? ¿Qué página? Aquí solo hay errores.",
	"Esto está más vacío que un corazón roto en San Valentín.",
	"404: No hay página, pero puedes disfrutar este error premium.",
	"La página se fue, pero dejó su espíritu aquí.",
	"404: Página no encontrada, pero encontraste un momento de reflexión.",
	"¡Rayos! Esto es más confuso que un mensaje de tu crush.",
	"404: Página extraviada, reportada como perdida.",
	"Esto no es lo que querías, pero es lo que obtuviste.",
	"La página que buscas está escondida detrás del sofá.",
	"404: Error encontrado, pero no la página.",
	"Esto es como buscar WiFi en el medio del desierto.",
	"404: Lo sentimos, la página fue a almorzar.",
	"Esto es tan vacío como mi nevera después del fin de semana.",
	"404: Esto no está mal, solo es un enfoque diferente.",
	"La página no está, pero al menos el error es simpático.",
	"404: Lo sentimos, la página se tomó el día libre.",
	"Esto está más perdido que yo en la vida.",
	"404: La página decidió empezar de nuevo en otra parte.",
	"Esto es más confuso que un test de física cuántica.",
	"404: Página no encontrada, pero ¿has probado meditar sobre ello?",
	"Esto está tan vacío como mi lista de compras después de olvidarla.",
	"404: Esta página se mudó, pero no dejó dirección.",
	"Esto está más roto que un juguete después de Navidad.",
	"404: Página perdida como un mensaje sin respuesta.",
	"Esto es más raro que encontrar dos calcetines iguales en la lavadora.",
	"404: ¿Buscas algo? Porque aquí no está.",
	"Esto no es la página que buscas, pero quizás es la que necesitas.",
	"404: Página fuera de servicio... y de paciencia.",
	"Esto está más vacío que la billetera después del Black Friday."
];



?>
	<div class="mdl-grid content-max-width">
		<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
			<img class="travolta" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/john-travolta.gif') ?>" >
			<h1 class="not-found">
				<?php echo $mensajes404[array_rand($mensajes404)] ?>
			</h1>
			<p class="not-found">
				Vas a ser redirigido a la página de inicio en <span id="seconds">x</span> segundos
			</p>
		</div>
	</div><!-- #primary -->

	<script>
		let seconds = 15;

		let time = document.getElementById('seconds')

		time.innerHTML= seconds

		setInterval(() => {
				seconds--
				time.innerHTML= seconds
			},
			1000
		)
		
		setTimeout( ()=>{ window.location = '/'; }, seconds * 1000);
	</script>

<?php
get_footer();
