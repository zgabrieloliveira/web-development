package ppi.trabalho14;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

@RestController
public class AddressController {

    private final List<Address> addresses = new ArrayList(
            Arrays.asList(
                    new Address("38400100", "Floriano Peixoto", "Centro", "Uberlândia"),
                    new Address("38400200", "Tiradentes", "Fundinho", "Uberlândia"),
                    new Address("38400300", "Lions Clube", "Osvaldo Rezende", "Uberlândia")
            )
    );

    @GetMapping("/hello")
    public String helloWorld() {
        return "Hello, World!";
    }

    @GetMapping("/address")
    public List<Address> getAllAddresses() {
        return this.addresses; // retorna todos os CEPs da lista
    }

    @GetMapping("/address/{cep}")
    public ResponseEntity<Address> getAddress(@PathVariable String cep) {
        // roda lista de CEPs e retorna o endereço correspondente
        for (Address address : addresses) {
            if (address.getCep().equals(cep)) {
                return ResponseEntity.ok(address); // 200
            }
        }
        return ResponseEntity.notFound().build(); // 404, não encontrado
    }

    // ao receber um novo endereço via POST, adiciona à lista
    @PostMapping("/address")
    public ResponseEntity<String> createAddress(@RequestBody Address address) {
        this.addresses.add(address);
        return ResponseEntity.ok("Endereço adicionado com sucesso!"); // mensagem de sucesso
    }

    @DeleteMapping("/address/{cep}")
    public ResponseEntity<String> deleteAddress(@PathVariable String cep) {
        // roda lista de CEPs e deleta o endereço correspondente
        for (Address address : addresses) {
            if (address.getCep().equals(cep)) {
                this.addresses.remove(address);
                return ResponseEntity.ok("Endereço removido com sucesso!"); // mensagem de sucesso
            }
        }
        return ResponseEntity.notFound().build(); // 404, não encontrado
    }

}
