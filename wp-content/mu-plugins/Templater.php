<?php
/**
 * Шаблонизатор
 */
namespace RE;
class Templater{

	private static
	string $regex = '/\[\[(?P<tag>.+)\]\](?P<content>.+)\[\[\/(?P=tag)\]\]/mUs';

	/**
	Функция загрузки HTML-шаблона с повторителями.
	Формат повторителя [[%%контент повторителя с аргументами %s замены%%]].
	Аргуметы функции:
	subject (string)		: шаблон
	args  (array)			: многомерный индексированный массив данных для автозамены.
	Первый элемент содержит данные для замены аргументов первого уровня (вне повторителей)
	Второй и последующие (n) элементы содержат данные для n-повторителя
	repeaters_only (bool)	: заменить только повторители, не трогая аргументы замены первого уровня.
	 */
	public static function vsprintf_rpt( $subject, $args = [], $repeaters_only = false ){
		if ( empty( $args ) ) return $subject;
		$m = [];
		preg_match_all( '/\[\[%%(.+)%%\]\]/mUs', $subject, $m );
		if ( empty( $m[0] ) )
			return $repeaters_only ? $subject : vsprintf( $subject, $args[0] );

		$subline = [];
		foreach( $m[1] as $i => $p ):
			$lines = [];
			foreach( $args[ $i + 1 ] as $line_args )
				$lines[] = self::format_esc( vsprintf( $p, $line_args ) );

			$subline[] = implode( '', $lines );
		endforeach;

		$pre_result = str_replace( $m[0], $subline, $subject );
		return $repeaters_only ? $pre_result : vsprintf( $pre_result, $args[0] );
	}

	/**
	 * Функция загрузки HTML-шаблона с именованными повторителями.
	 * Формат повторителя
	 *
	 * [[ИМЯ_ПОВТ]]контент повторителя с аргументами %s замены[[/ИМЯ_ПОВТ]]
	 *
	 * Аргуметы функции:
	 * @param string $subject	: шаблон
	 * @param array $args		: многомерный индексированный массив данных для автозамены, где каждый элемент ($n => $data) соответствует порядку аргументов автозамены из исходного шаблона ( %[$n+1]$s => $data ).
	 * При этом элементы сами являются многомерными массивами, где
	 * столбцы -
	 * `tag` 		=> имена повторителей
	 * `content`	=> индексированный одномерный массив данных для автозамены функцией vsprintf внутри повторителя
	 * строки - порядок вывода повторителей
	 * @param boolean $invert 	: вернуть обработку только указанного в первом элементе $args повторителя, игнорируя все прочие повтрители и аргументы автозамены.
	 *
	 * @return string
	 */
	public static function render( $subject, $args = [], $invert = false ){
		if ( empty( $args ) ) return $subject;
		$m = [];
		preg_match_all( self::$regex, $subject, $m );
		$result = self::_parse_rpt( $subject );
		if ( empty( $result ) )
			return $invert ? $subject : vsprintf( $subject, $args );

		$pre_result = str_replace( $result['data'][0], '', $subject );

		$replace = [];
		foreach( $args as $data ) :

			$replace []= self::_get_rpt_data( $data, $result );

			if ( $invert ) break;
		endforeach;

		return $invert ? $replace[0] : vsprintf( $pre_result, $replace );
	}

	public static function format_esc( $format ){
		return str_replace( '%', '%%', $format );
	}

	/**
	 * Рекурсивная функция поиска вложенных повторителей
	 * tag	    - список имён найденных повторителей
	 * content	- список содержимого повторителей, включая вложенные
	 * clear	- список содержимого повторителей, исключая вложенные
	 */
	public static function _parse_rpt( $subject ){
		$m = [];
		preg_match_all( self::$regex, $subject, $m );
		if ( empty( $m[0] ) ) return false;

		$result = [
			'tag'		=> $m['tag'],
			'content'	=> $m['content'],
			'clear'		=> [],
		];
		foreach( $m['content'] as $found ):
			$inner = self::_parse_rpt( $found );
			if ( is_array( $inner ) ) :
				$result['tag'] = array_merge( $result['tag'], $inner['result']['tag'] );
				$result['content'] = array_merge( $result['content'], $inner['result']['content'] );
				$result['clear'] = array_merge( $result['clear'], [ str_replace( $inner['data'][0], '', $found ) ], $inner['result']['clear'] );
			else :
				$result['clear'] []= $found;
			endif;
		endforeach;

		return [ 'result' => $result, 'data' => $m ];
	}

	public static function _get_rpt_data( $data, $context ){
		if ( is_array( $data ) ) :
			$subline = '';

			foreach( $data as $row ) :
				$content = $row['content'] ?? @$row['data'];
				if ( isset( $row['tag'] ) && ! empty( $content ) ) :
					if ( is_array( $content ) )
						foreach( $content as $i => $maybe_subarray ):
							if ( is_array( $maybe_subarray ) )
								$content[ $i ] = self::_get_rpt_data( $maybe_subarray, $context );
						endforeach;
					$subline .=	( false !== $key = array_search ( $row['tag'], $context['result']['tag'] ) ) ?
						vsprintf( $context['result']['clear'][ $key ], $content ) : ( is_array( $content ) ? implode( '', $content ) : $content );
				elseif ( ! empty( $content ) ) :
					$subline .= ( is_array( $content ) ? implode( '', $content ) : $content );
				elseif ( ! empty( $row['tag'] ) ) :
					$subline .= ( false !== $key = array_search ( $row['tag'], $context['result']['tag'] ) ) ?
						$context['result']['clear'][ $key ] : '';
				endif;
			endforeach;
			$out = $subline;
		else :
			$out = $data;
		endif;

		return $out;
	}
}
