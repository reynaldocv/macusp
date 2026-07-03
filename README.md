# "Macusp" - pawtucket2 - Collectiveaccess 

Esse é um tema (theme) "MACUSP" para o pawtucket2 - collectiveaccess. 
O pawtucket2 é a interface para o usuario final do acervo online MACUSP. 
A seguir é descrito em detalhes a funcionalidade de esse tema. 

O Conteudo está dividido nas seguintes seções: 

1. [Conteúdo ](#1--conteudo-do-tema-macusp).  
    - [assets](#11-assets)
    - [conf](#12-conf)
    - [controllers](#13-controllers)
    - [locale](#14-locale)
    - [views](#15-views)    
2. [Web Page - Estrutura](#2--webpage---estrutura).   
    - [Configuração dos estilos css](#21-configuração-de-estilos-css)
    - [header](#21-header)
    - [footer](#22-footer)
3. [Agregando Idiomas](#3--agregando-idiomas). 

4. [Agregando Idiomas](#3--agregando-idiomas). 

5. [Organigrama](#5--organigrama). 

## 1- Conteudo do tema MACUSP

Esse tema contém 6 pastas, a seguir mencionamos a sua funcionalidade e seu conteudo: 
### 1.1 assets: 
  contem os arquivos (logos e gráficos) de imagens e de estilos (css). 

  - **pawtucket/css/**: contém a lista de arquivos de estilos (css). Nesse pastas dois arquivos são importantes: main.css e macusp.css. 
    - **main.css**: arquivo principal de pawtucket2; nesse arquivo foi agregado as cores do macusp.  
    - **macusp.css**: arquivo que contém os estilos con relação ao tema macusp. 
  - **pawtucket/graphics/**: contém os gráficos mostrados do tema, como arquivos de imagens.    

### 1.2 *conf: 
  - **app.conf**
  - **assets.conf**
  - **browse.conf**   
  - **detail.conf**
  - **macusp_frontpage.conf**
  - **search.conf**

> [!IMPORTANT]
> Os arquivos browse.conf, detail.conf, macusp_frontpage.conf e search.conf estão configurados 
> com relação às definições:  
> - *works* (em relação às obras de arte)
> - *artists* (em relacção às entidades artistas)
> - *exhibitions* (em relacção às ocurrências exposições)
> mais detalhes (see [Configuração](#configuraçao)). 

### 1.3 controllers: 
  Contém os arquivos controllers (são arquivos backend, eles têm accesso ao banco de dados, queries, etc...).

  - **BrowseController.php** 
  Arquivo controller que está encargado da navegação das seguintes páginas: 
      - obras - *works* [index.php/Browse/works](http://143.107.130.173/admacervo/macusp/index.php/Intro/works). 
      - artistas - *artists* [index.php/Browse/artists](http://143.107.130.173/admacervo/macusp/index.php/Browse/artists). 
      - exposições - *exhibitions* [index.php/Browse/exhibitions](http://143.107.130.173/admacervo/macusp/index.php/Intro/exhibitions). 

> [!IMPORTANT]
> O arquivo de configuração dele é o browse.conf. 
    
  - **DetailController.php**
  Arquivo controller responsável pela exhibição de cada artista (artists), coletivo (groups), obra (works), exposição (exhibitions) e publicação (publications) :
      - obras - *works* [index.php/Detail/works/38512](http://localhost/pawtucket/index.php/Detail/works/38512). 
      - artistas - *artists* [index.php/Detail/artists/5023](http://143.107.130.173/admacervo/macusp/index.php/Detail/artists/5023). 
      - coletivos - *groups* [index.php/Detail/artists/6657](http://143.107.130.173/admacervo/macusp/index.php/Detail/artists/6657). 
      - exposições - *exhibitions* [index.php/Detail/exhibitions/2524](http://143.107.130.173/admacervo/macusp/index.php/Detail/exhibitions/2524). 
       - publicações - *publications* [index.php/Detail/publications/1296](http://143.107.130.173/admacervo/macusp/index.php/Detail/publications/1296)

> [!IMPORTANT]
> O arquivo de configuração dele é o detail.conf, que são declarados todas a visualizações individuais: works, artists, groups, exhibitions e publications.  


  - **InfoController.php** 
  Arquivo controller responsável pelos quadros de informação mostrados quando o usuário faz click no 
  icono (i), 
  por exemplo, na página de [Tarsila do Amaral](http://143.107.130.173/admacervo/macusp/index.php/Detail/artists/5023) temos obras, exposições e publicações con o icono de info 
  onde o resultado é mostrado na parte direita da webpage.

  - **IntroController.php**
  Arquivo controller responsável pelas paginas de inicios 
      - obras - *works* [index.php/Intro/works](http://143.107.130.173/admacervo/macusp/index.php/Intro/works). 
      - artistas - *artists* [index.php/Intro/artists](http://143.107.130.173/admacervo/macusp/index.php/Intro/artists). 
      - exposições - *exhibitions* [index.php/Intro/exhibitions](http://143.107.130.173/admacervo/macusp/index.php/Intro/exhibitions). 

> [!IMPORTANT]
> O arquivo de configuração dele é o macusp_frontpage.conf onde é declarado: works, artists e exhibitions.  

  - **SearchController.php**
  Arquivo controller responsável pela busca de informacão. Ele retorna o resultados das buscas.
  Também é responsável do multisearch (barra de busca coletiva do menu). 

  - **MacuspSearchController.php**    
  Arquivo controller, similar ao SearchController, onde ele retorna o resultados das buscas com o icono info (i).

  - **pageController.php**  
  Arquivo controller focado em criar novas páginas web.
  
  - **ScanController.php**
  Arquivo controller focado nas buscas avançadas de obras, artistas e exposições (*works*, *artists* e *exhibitions*). 
    
###  1.4 locale
 Nessa pasta está os arquivos dos idiomas. Cada subpasta contém dois documentos: 
   - en_US
      - messages.po (arquivo contendo as traduções)
      - messages.mo (arquivo codificado)
   - pt_BR
      - messages.po (arquivo contendo as traduções)
      - messages.mo (arquivo codificado)    

   os arquivos messages.mo são compilados a partir dos arquivos messages.po com, usando o seguinte comando (no Ubuntu): 
  
      msgfmt messages.po -o messages.mo 

###  1.5 views
Contém os arquivos de visualização (são arquivos front-end).
> [!NOTE]
> Toda consulta ao banco de dados é feita no arquivos [controllers](#13-controllers)
> e essa informação vai para os arquivos na pasta **views** (arquivos front-end). 

  - **Browse**: 
  - **Contact**
  - **Details**
  - **Form**
  - **Gallery**
  - **Macusp**
  - **PageFormat**: Arquivos da estrutura da página web (header, footer, etc...)
  - **pages**
  - **scan**
  - **search**

## 2- Webpage - Estrutura
### 2.1 Configuração de Estilos (css)
As modificações feita foram nos arquivos /assets/css/main.css e /assets/css/macusp.css. 
Esses arquivos e bibliotecas usadas no tema, devem ser declaradas no arquivo de configuração 
conf/assets.conf

    themePackages = {      
      pawtucket = {
        css = css/main.css:100,
        macusp = css/macusp.css:100, 
        carrousel = css/carrousel.css, 
        banner = css/macusp-banner.css:100, 
        fonts = css/fonts.css,
        fontAwesome = css/Font-Awesome/css/fontawesome-all.css,     
        themecss = css/theme.css:200
      }
    }

    themeLoadSets = {    
      _default = [
        pawtucket/css, pawtucket/macusp, pawtucket/carrousel, pawtucket/banner, pawtucket/fonts, pawtucket/themecss, pawtucket/fontAwesome #, pawtucket/fontjs  
      ]
    }

Em themePackages and themeLoadSets foram definidos as variáveis css e macusp para que os estilos sejam usadas 
no momento da execução do tema MACUSP. 

### 2.2 Header 
O arquivo está localizado no views/pawtucket/pageFormat/pageHeader.php. 
A estrutura foi mantida na maior parte, as modificações feitas foram duas. 
Implementamos dois arquivos para fazer os menus de idiomas e de navegação 
(*WORKS - ARTISTS - EXHIBITIONS - ADVANCED SEARCH*).     
    
  - **macusp-flags**: (recomendamos não mexer), nesse arquivo listamos todos os idiomas configurados no sistema
    para fixar cual é o idioma principal.     
    
  - **macusp-menuitems.php**: é responsável da barra de menu (*WORKS - ARTISTS - EXHIBITIONS - ADVANCED SEARCH*).      

### 2.3 Footer
O arquivo está localizado no views/pawtucket/pageFormat/pageFooter.php. 

### 3- Pagina Home
Os arquivos da página de inicio estão no views/pawtucket/Front 
([index.php](http://143.107.130.173/admacervo/macusp/))
São um arquivo por cada idioma ativado, nesse caso só temos dois arquivos: 
    - front_page_en_US.php 
    - front_page_pt_BR.php 

> [!IMPORTANT]
> - Ao adicionar outro idioma, por exemplo es_ES, é só criar un arquivo com o 
> nome 'front_page_es_ES.php' (recomendamos copiar o arquivo 'front_page_pt_BR.php', mudar de nome para 
  'front_page_es_ES.php', e fazer a tradução de conteúdo.) 
  
## 4- Agregando Idiomas

  ### Passos a seguir (como exemplo agregaremos o idioma es_ES(espanhol)): 

  - **Primeiro** Aquivo configuração: declarar os idiomas no arquivo {pawtucket2}/app/config/app.conf

      ui_locales = [en_US, pt_BR, es_ES]

  - **Segundo**: Gerar a pasta respectiva do idioma agregado no {macusp}/locale/. Nesse exemplo, devemos criar 
      a pasta {macusp}/locale/es_ES e seus respectivos arquivos: 
        - messages.po
        - messages.mo 

  - **Terceiro**: Aquivos locales: localizados no {macusp}/locale/. Para cada idioma em seu respectivo 
  arquivo message.po deve ser declarado as seguintes variáveis: 

    - O variável "flags:pawtucket:language" deve ter o acrônimo do idioma na pasta que estiver.  

          msgid "flags:pawtucket:language"
          msgstr "en_US"

    - As variáveis "flags:lang:{acrônimo}" deve ter todos os acrônimos dos idioma declarados no arquivo de configuração e o nome do idioma, no seu respectivo idioma. 

          msgid "flags:lang:{acrônimo}"
          msgstr "{nombe do idioma}"

    Por exemplo, no arquivo {macusp}/locale/en_US/messages.po devemos declarar as seguintes variáveis:

          # definimos a variável "flags:lang:language" com o acrônimo 
          # do seu respectivo idioma (nesse caso en_US). 

          msgid "flags:pawtucket:language"
          msgstr "es_ES"

          # definimos as variáveis "flags:lang:{acrônimo}" para cada 
          # idioma e seu respectivo nome en inglês. 

          msgid "flags:lang:en_US"
          msgstr "Inglés"

          msgid "flags:lang:pt_BR"
          msgstr "Portugués"

          msgid "flags:lang:es_ES"
          msgstr "Español"

    Fazer esses pasos para todos os idiomas declaramos. 

> [!IMPORTANT]
> Não esquecer de compilar os arquivo messages.po e gerar os messages.mo ([comando no Ubuntu](#14-locale)). 
 
  - **Quarto**: Procurar ma imagem tipo .svg de tamanho 30x30 e copiar na pasta {pawtucket2}/assets/graphics/flags/
  com o nome do {acronimo}.svg (nesse caso sería es_ES.svg)

## 5- Organigrama 

Here is a simple flow chart:



```mermaid
graph TD
    Home[Home] --> Works[Obras]
    Home --> Artists[Artistas]
    Home --> Exhibitions[Exposições]    
    Home --> MultiSearch[Busca Geral]
    Home --> AdvancedSearch[Busca Avançãda]
    
    %% Definición de los enlaces
    click Home "http://143.107.130.173/admacervo/macusp/index.php" "<b>Views</b>: Front _blank
    click Works "http://143.107.130.173/admacervo/macusp/index.php" "<b>Controllers</b>: BrowserController <br> Views: Browser <br> config: browse.conf <br> Front" _blank
    click Artists "http://143.107.130.173/admacervo/macusp/index.php" "<b>Controllers</b>:             <br> Views: Front <br> config:  Front" _blank
    click Exhibitions "http://143.107.130.173/admacervo/macusp/index.php" "<b>Controllers</b>:             <br> Views: Front <br> config: Front" _blank
    click VP1 "https://google.com" "Ir a soporte" _blank

```



> [!CAUTION]
> Como vas

> [!NOTE]
> Como vas

## Conteudo

# Example headings

## Sample Section

## This'll be a _Helpful_ Section About the Greek Letter Θ!
A heading containing characters not allowed in fragments, UTF-8 characters, two consecutive spaces between the first and second words, and formatting.

## This heading is not unique in the file

TEXT 1

## This heading is not unique in the file

TEXT 2

# Links to the example headings above

Link to the sample section: [Link Text](#sample-section).

Link to the helpful section: [Link Text](#thisll-be-a-helpful-section-about-the-greek-letter-Θ).

Link to the first non-unique section: [Link Text](#this-heading-is-not-unique-in-the-file).

Link to the second non-unique section: [Link Text](#this-heading-is-not-unique-in-the-file-1).

> [!IMPORTANT]
> O arquivo de configuração dele é o detail.conf, que são declarados todas a visualizações individuais. 

> [!NOTE]
> Useful information that users should know, even when skimming content.

> [!TIP]
> Helpful advice for doing things better or more easily.

> [!IMPORTANT]
> Key information users need to know to achieve their goal.

> [!WARNING]
> Urgent info that needs immediate user attention to avoid problems.

> [!CAUTION]
> Advises about risks or negative outcomes of certain actions.