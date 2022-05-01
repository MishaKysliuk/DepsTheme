<?php
   /*
   * Test the given binary to see if it returns a valid version string.
   *
   * @param string $path The absolute path to a binary file.
   * @param string $file relative path to media
   *
   * @return bool True (or truthy) if found.
   */
  function dv_exif_tool_found( $path, $file ) {

    exec( $path . ' ' . $file . ' 2>&1', $exiftool_version );
    if ( $exiftool_version ) {
      foreach ( $exiftool_version as $jout ) {
		  error_log($jout);
        if ( preg_match( '/ExifTool Version Number/', $jout ) ) {
          return true;
        }
      }
    }

    return false;
  }


  /*
   * Add EXIF Copyright information to uploaded image using exiftool
   *
   *
   * @param $upload
   * @param $context
   *
   * @return mixed
   */
  function add_exif_data_on_upload( $upload, $context ) {

    if ( $upload['type'] != 'image/jpeg' && $upload['type'] != 'image/png' ) {
      return $upload;
    }
    if ( dv_exif_tool_found( '/home/username/exiftool/exiftool', $upload['file'] ) ) {
      $params = get_exiftool_params();

      $exif_params = implode( ' ', array_map(
        function ( $v, $k ) {
          return $k . '="' . $v . '"';
        },
        $params,
        array_keys( $params )
      ) );

      $exec_string = '/home/username/exiftool/exiftool -all= ' . $exif_params . ' -overwrite_original -charset iptc=utf8 ' . dv_escapeshellarg( $upload['file'] ) . ' 2>&1';
error_log($exec_string);
      shell_exec( $exec_string );

    }

    return $upload;
  }

  add_filter( 'wp_handle_upload', 'add_exif_data_on_upload', 10, 2 );


  /*
   * EXIF tool params
   *
   * @return array
   */
  function get_exiftool_params() {
    return [
      "-CreatorWorkURL"                        => "https://example.com/",
      "-EXIF:Copyright"                        => "© Example, example.com",
      "-IPTC:CodedCharacterSet"                => "utf8",
      "-IPTC:Contact"                          => "info@example.com",
      "-IPTC:CopyrightNotice"                  => "© Example, example.com",
      "-IPTC:Source"                           => "https://example.com/",
      "-IPTC:Credit"                           => "Example",
      "-XMP-cc:LegalCode"                      => "https://creativecommons.org/licenses/by-nc-nd/4.0/legalcode",
      "-XMP-cc:License"                        => "https://creativecommons.org/licenses/by-nc-nd/4.0/",
      "-XMP-cc:MorePermissions"                => "https://example.com/",
      "-XMP-dc:Creator"                        => "Example",
      "-XMP-iptcCore:CreatorWorkURL"           => "https://example.com/",
      "-XMP-iptcExt:ArtworkCopyrightNotice"    => "© Example, example.com",
      "-XMP-iptcExt:ArtworkCopyrightOwnerName" => "Example",
      "-XMP-pur:Copyright"                     => "© Example, example.com",
      "-XMP-xmp:BaseURL"                       => "https://example.com/",
      "-XMP-xmpRights:Marked"                  => "True",
      "-XMP-xmpRights:UsageTerms"              => "Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0) https://creativecommons.org/licenses/by-nc-nd/4.0/ ; details at https://example.com/",
      "-XMP-xmpRights:Owner"                   => "Example, https://example.com/",
      "-XMP-xmpRights:WebStatement"            => "https://creativecommons.org/licenses/by-nc-nd/4.0/"
    ];
  }

  /*
   * Escape command strict for safety
   */
  function dv_escapeshellarg( $arg ) {
    if ( PHP_OS === 'WINNT' ) {
      $safe_arg = str_replace( '%', ' ', $arg );
      $safe_arg = str_replace( '!', ' ', $safe_arg );
      $safe_arg = str_replace( '"', ' ', $safe_arg );

      return '"' . $safe_arg . '"';
    }
    $safe_arg = "'" . str_replace( "'", "'\\''", $arg ) . "'";

    return $safe_arg;
  }
?>
