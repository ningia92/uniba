# My uniba projects and exercises :man_technologist:

Collection of projects and exerices completed during the bachelor's degree in computer science at University of Bari.

The codes and files are divided by course.

------------------------------------------------------------------------

## Laboratorio di informatica (2016): project in C language
### Management of a music playlist

Archives to create:
- Tracks: ARTIST, TITLE, GENRE (pop, rock, metal, latin, R&B), STARS (from 0 to 5 stars)
- Playlist

Operations:
1. Search for a song by title in the tracks archive
2. Viewing tracks for each genre
3. Creation and Viewing of playlist of 10 tracks
4. Every time a track is inserted into a playlist -> ++star
5. Viewing songs sorted by stars

------------------------------------------------------------------------

## Algoritmi e strutture dati (2018): exercises in C++ language
Realizations of the structures seen in class, and the exercises/algorithms with relative execution tests

------------------------------------------------------------------------

## Metodi avanzati di programmazione (2018): K-means project :pick:
Client-server system called 'K-Means". The server includes data mining capabilities for discovering data clusters. The client is a Java applet that allows you to take advantage of the remote discovery service and displays the knowledge (cluster) discovered.

### Data mining

The purpose of data mining is the (semi)
automatic extraction of knowledge hidden in large
databases in order to make it available and
directly usable

Areas of application:
1. forecasting:
use of known values ​​to forecast unknown quantities (e.g. estimating the
turnover of a point of sale based on its characteristics);
2. classification:
identification of the characteristics that indicate to which group a certain
case belongs (e.g. discrimination between ordinary and fraudulent behaviors);
3. segmentation (or clustering):
identification of groups with homogeneous elements within the group and different
from group to group (e.g. identification of groups of consumers with
similar behaviors);
4. association:
identification of elements that often appear together in a given
event (e.g. products that frequently enter the same
shopping cart);
5. sequences:
identification of a chronology of associations (e.g. visit paths of a
website).  
    …

#### Clustering

Given:
  - a collection D of transactions, where each transaction is a vector of attribute-value pairs (item);  
  - an integer k;
    
The goal is:
  - partition D into k sets of transactions D1, …, Dk;
    
Such that:
  - Di (i=1,…,k) is a homogeneous segment (selection) of D.

#### Problems

1. How do I perform clustering?  
   - K-means.
    
2. How do I represent clusters?  
   - Compute and store cluster centroids.
    
3. How do I use clusters in real applications?  
   - Minimize the distance between a new transaction and the cluster representation to discover the cluster it belongs to.

#### k-means
```
Kmeans(D,k)-:clusterSet
clusterSet: set of k segments Di : each
  segment Di is a set of transactions in D
begin
1. initialize clusterSet with
initially empty segments
2. assign to each segment of clusterSet a
randomly chosen transaction from D
3. do
  for(transaction:D)
  3.1 Di = cluster(clusterSet,transaction)
  3.2 move transaction in segment Di
while (at least one transaction changes cluster)
4. return clusterSet;
end
```

------------------------------------------------------------------------

## Ingegneria del software (2017): museum of Durres project

### Goals:
- Increase, with reference to a museum structure, the number of visitors and their satisfaction as well as improving the hedonic experience.
- Extend the concept of "visit" by creating new paths of use and eliminating the infrastructures and visiting aid devices usually used in museums, such as audio guides, info points, brouchures, etc.
- Improve the hedonic experience connected to the actual visit to the museum through a low-cost multimedia audio guide, accessible via a common smartphone, interactive and updatable "on the fly" every time new finds are displayed.

### Reference scenario:
- The case study represents a real need expressed by the following stakeholders:
  - Archeological Museum of Durres
  - University of Bari - Aldo Moro, as part of one of the various collaborative initiatives with the Albanian state
  - Apulian IT Production District

#### The exhibit card:
- The creation of a software is planned that allows:
  - the museum staff to easily catalogue each exhibit and describe it while associating it with the information that is intended to be displayed to the visitor;
  - the visitor to enjoy it with the simplicity and immediacy that modern technology allows.
- The software must allow the museum staff to create an "exhibit card" for each new exhibit to be displayed:
  - text description, any other multimedia information (photos, videos, audio files, etc.) a unique identification code and a QR-Code generated during the creation of the card that will subsequently allow the exhibit card to be recalled in real time through an APP that will be created specifically for this purpose, displaying and reproducing all the contents.
 
#### QR-Code:
- Quick Rensponse Code
  - is a two-dimensional barcode, i.e. matrix, composed of black modules arranged within a square-shaped pattern.
  - is used to store information generally intended to be read by a mobile phone or smartphone.
  - QR-Codes can be read by any smartphone equipped with a special reading program.

#### The system to be created: Functional Requirements
- The software to be created will consist of two components, server and mobile, one dedicated to the storage and management of multimedia content that is intended to be delivered and one for the use of the content.
  - The server component is a WEB Portal for the promotion of the museum and its activities, the storage and management of multimedia content. A "showcase" and information section will be flanked by a back-office section with restricted access for museum staff in which to record the various information sheets associated with the various finds and the videos that are intended to be conveyed with the mobile component.
  - The mobile component, created as an APP for smartphones, will allow the use of the content. The APP will be developed for Android devices and will allow the visitor, after having framed the QR Code of the find of interest, and will proceed to retrieve the information on the work and view the relative sheet. The user will be able to consult the card either by reading the information on the screen or by starting the text-to-speech engine and listening to the information through the smartphone.

#### Server component
WEB portal for the promotion of the museum and its activities, together with an information and purely image section, will have a back-office section with restricted access for museum staff in which to register the various information sheets and videos that are intended to be conveyed through the APP. The requirements of the back-office section are reported below:
- R1: Insertion, modification and deletion of a museum structure. The fields that define the structure will be agreed (for example name, address, opening hours, description, virtual visit video, etc ...).
- R2: Insertion, modification and deletion of a work of art. The fields that define the work will be agreed (name, internal code, short description, extended description, etc ...). The staff in charge will be able to choose between the various fields, which will be displayed in the use sheet of the APP and therefore which can be pronounced by the speech synthesis engine
present in the APP.
- R3: Publication of works of art. The concept of publication allows for the efficient management of the workflow underlying the census of works. The cards can be drawn up in multiple phases and will be made available to the public only once the publication has been carried out. This will allow for complete and revised content to always be available to the public.
- R4: QR CODE Printing: section dedicated to downloading and printing individual QR codes to be applied near the registered works of art.
- R5: Insertion, modification and deletion of audio files associated with individual works of art. These files represent additional content to that present in the card and may contain, for example, background music or provide information that goes beyond the simple description of the work.
- R6: account management by privilege levels (administrator, museum operator, etc.).

#### Mobile component
APP for Android devices that will allow the visitor to use the contents inserted through the server component. When started, it will wait until the visitor frames a QR Code relating to a work of interest. The APP will proceed to retrieve and display the information on the work contained in the artifact sheet, also giving the possibility of reproducing, upon request of the visitor, any audio/video content available.
The user can consult the sheet either by reading the information on the screen or by starting the speech synthesis engine and listening to the information through headphones attached to the smartphone.
The requirements of the APP are reported below, in a timely manner:
- R7: display of the sheet of a work of art starting from the scanning of the identifying QR Code.
- R8: start of the speech synthesis of the information provided in the sheet of the work of art.
- R9: selection and reproduction of any audio/video attached to the sheet.
