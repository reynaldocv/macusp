# "Macusp" - pawtucket2 - Collectiveaccess 

Esse é um tema (theme) "MACUSP" para o pawtucket2 - collectiveaccess. 
O pawtucket2 é a interface para o usuario final do acervo online MACUSP. 
A seguir é descrito em detalhes a funcionalidade de esse theme. 

O Conteudo está dividido nas seguintes seções: 

1. [Conteúdo ](#1- conteudo-do-theme-macusp).
2. Conteudo e Funcionalidad [Link Text](#conteudo).
2. Conteudo e Funcionalidad [Link Text](#macusp). 


## 1- Conteudo do theme MACUSP
Esse theme contém 6 pastas, a seguir mencionamos a sua funcionalidade e seu conteudo: 
### 1.1 assets: 
  contem os arquivos (logos e gráficos) de imagens e de estilos (css). 

  - **pawtucket/css/**: contém a lista de arquivos de estilos (css). Nesse pastas dois arquivos são importantes: main.css e macusp.css. 
    - **main.css**: arquivo principal de pawtucket2; nesse arquivo foi agregado as cores do macusp.  
    - **macusp.css**: arquivo que contém os estilos con relação ao theme macusp. 
  - **pawtucket/graphics/**: contém os gráficos mostrados do theme, como arquivos de imagens.    

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
> - works (em relação às obras de arte)
> - artists (em relacção às entidades artistas)
> - exhibitions (em relacção às ocurrências exposições)
> mais detalhes (see [Configuração](#configuraçao)). 

### 1.3 controllers: 
  Contém os arquivos controllers (são arquivos backend, eles têm accesso ao banco de dados, queries, etc...).

  - **BrowseController.php** 
  Arquivo controller que está encargado da navegação das seguintes páginas: 
      - obras -works [index.php/Browse/works](http://143.107.130.173/admacervo/macusp/index.php/Intro/works). 
      - artistas - artists [index.php/Browse/artists](http://143.107.130.173/admacervo/macusp/index.php/Browse/artists). 
      - exposições - exhibitions [index.php/Browse/exhibitions](http://143.107.130.173/admacervo/macusp/index.php/Intro/exhibitions). 

> [!IMPORTANT]
> O arquivo de configuração dele é o browse.conf. 
    
  - **DetailController.php**
  Arquivo controller responsável pela exhibição de cada artista (artists), coletivo (groups), obra (works), exposição (exhibitions) e publicação (publications) :
      - obras - works [index.php/Detail/works/38512](http://localhost/pawtucket/index.php/Detail/works/38512). 
      - artistas - artists [index.php/Detail/artists/5023](http://143.107.130.173/admacervo/macusp/index.php/Detail/artists/5023). 
      - coletivos - groups [index.php/Detail/artists/6657](http://143.107.130.173/admacervo/macusp/index.php/Detail/artists/6657). 
      - exposições - exhibitions [index.php/Detail/exhibitions/2524](http://143.107.130.173/admacervo/macusp/index.php/Detail/exhibitions/2524). 
       - publicações - publications [index.php/Detail/publications/1296](http://143.107.130.173/admacervo/macusp/index.php/Detail/publications/1296)

> [!IMPORTANT]
> O arquivo de configuração dele é o detail.conf, que são declarados todas a visualizações individuais: works, artists, groups, exhibitions e publications.  


  - **InfoController.php** 
  Arquivo controller responsável pelos quadros de informação mostrados quando o usuário faz click no 
  icono (i), 
  por exemplo, na página de [Tarsila do Amaral](http://143.107.130.173/admacervo/macusp/index.php/Detail/artists/5023) temos obras, exposições e publicações con o icono de info 
  onde o resultado é mostrado na parte direita da webpage.

  - **IntroController.php**
  Arquivo controller responsável pelas paginas de inicios 
      - obras -works [index.php/Intro/works](http://143.107.130.173/admacervo/macusp/index.php/Intro/works). 
      - artistas - artists [index.php/Intro/artists](http://143.107.130.173/admacervo/macusp/index.php/Intro/artists). 
      - exposições - exhibitions [index.php/Intro/exhibitions](http://143.107.130.173/admacervo/macusp/index.php/Intro/exhibitions). 

> [!IMPORTANT]
> O arquivo de configuração dele é o macusp_frontpage.conf onde é declarado: works, artists e exhibitions.  

  - **SearchController.php**
  - **MacuspSearchController.php**    
  - **pageController.php**  
  - **ScanController.php**
    
###  1.4 locale
 Nessa pasta está os arquivos dos idiomas. Cada subpasta contém dois documentos: 
   - en_US
      - messages.po (arquivo contendo as traduções)
      - messages.mo (arquivo codificado)
   - pt_BR
      - messages.po (arquivo contendo as traduções)
      - messages.mo (arquivo codificado)
    

   o arquivo messages.mo é compilado a partir do message.po com o seguinte comando (no Ubuntu): 
  
      msgfmt messages.po -o messages.mo 

###  1.5 views
Contém os arquivos de visualização (são arquivos front-end).
> [!NOTE]
> Toda consulta ao bando de dados é feita no arquivos [controllers](#13-controllers)
> e essa informação vai para os arquivos na pasta **views** (arquivos front-end). 

  - **Browse**
  - **Contact**
  - **Details**
  - **Form**
  - **Gallery**
  - **Macusp**
  - **PageFormat**
  - **pages**
    
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