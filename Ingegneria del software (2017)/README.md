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
